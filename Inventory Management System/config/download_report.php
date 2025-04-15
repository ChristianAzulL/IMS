<?php 
error_reporting(E_ALL);
ini_set('max_execution_time', 300);  // 5 minutes
ini_set('memory_limit', '4G');       // 4 GB
ini_set('display_errors', 1); 

include "database.php";
include "on_session.php";
require_once '../../vendor/autoload.php'; // Load mPDF

$response = array('success' => false, 'message' => 'Something went wrong.');

// Defaults to avoid undefined variable warnings
$selected_wh = $_GET['select_warehouse'] ?? null;
$user_warehouse_ids = $user_warehouse_ids ?? [];
$productDescription = $productDescription ?? 'Product';
$brandName = $brandName ?? 'Brand';
$categoryName = $categoryName ?? 'Category';

// Sanitize user warehouse IDs
$quoted_warehouse_ids = array_map(function ($id) use ($conn) {
    return "'" . $conn->real_escape_string(trim($id)) . "'";
}, $user_warehouse_ids);
$imploded_warehouse_ids = implode(",", $quoted_warehouse_ids);

// Display warehouse name or "All Warehouses"
if ($selected_wh) {
    $stmt = $conn->prepare("SELECT warehouse_name, hashed_id FROM warehouse WHERE hashed_id = ? LIMIT 1");
    $stmt->bind_param("s", $selected_wh);
    $stmt->execute();
    $result = $stmt->get_result();
    $api_warehouse_name = "Unknown";
    $api_warehouse_id = null;

    if ($row = $result->fetch_assoc()) {
        $api_warehouse_name = $row['warehouse_name'];
        $api_warehouse_id = $row['hashed_id'];
        $warehouses_names = $api_warehouse_name;
    }
} else {
    // Sanitize user warehouse IDs and quote them
$quoted_warehouse_ids = array_map(function ($id) use ($conn) {
    // Ensure IDs are surrounded by quotes
    return "'" . $conn->real_escape_string(trim($id)) . "'";
}, $user_warehouse_ids);

// Implode the quoted warehouse IDs for the IN clause
$imploded_warehouse_ids = implode(",", $quoted_warehouse_ids);

// Prepare the SQL with the quoted warehouse IDs
$sql = "SELECT warehouse_name FROM warehouse WHERE hashed_id IN ($imploded_warehouse_ids)";

// Prepare the statement
$stmt = $conn->prepare($sql);

// Execute the query
$stmt->execute();
$result = $stmt->get_result();

// Store the warehouse names
$warehouse_names = [];
while ($row = $result->fetch_assoc()) {
    $warehouse_names[] = $row['warehouse_name'];
}

// Handle case when no warehouse names are found
if (empty($warehouse_names)) {
    $warehouses_names = "No warehouses found"; // Fallback message
} else {
    $warehouses_names = implode(', ', $warehouse_names); // Join with commas
}



}




// Category Query
$category_query = "SELECT category_name, hashed_id FROM category ORDER BY category_name ASC";
$category_res = $conn->query($category_query);

$rowz = [];

if ($category_res && $category_res->num_rows > 0) {
    while ($row = $category_res->fetch_assoc()) {
        $c_category_name = $row['category_name'];
        $c_category_id   = $row['hashed_id'];
        $category_capital = 0;
        $category_qty = 0;

        $stmt = $conn->prepare("
            SELECT p.hashed_id 
            FROM product p 
            LEFT JOIN brand b ON b.hashed_id = p.brand 
            WHERE p.category = ?
        ");
        $stmt->bind_param("s", $c_category_id);
        $stmt->execute();
        $product_result = $stmt->get_result();

        $product_ids = [];
        while ($product = $product_result->fetch_assoc()) {
            $product_ids[] = $product['hashed_id'];
        }

        foreach ($product_ids as $product_id) {
            if ($selected_wh && $api_warehouse_id) {
                $stock_stmt = $conn->prepare("
                    SELECT capital 
                    FROM stocks 
                    WHERE item_status = 0 
                        AND product_id = ? 
                        AND YEAR(`date`) = YEAR(CURDATE()) 
                        AND MONTH(`date`) = MONTH(CURDATE())
                        AND warehouse = ?
                ");
                $stock_stmt->bind_param("ss", $product_id, $api_warehouse_id);
            } else {
                $stock_stmt = $conn->prepare("
                    SELECT capital 
                    FROM stocks 
                    WHERE item_status = 0 
                        AND product_id = ? 
                        AND YEAR(`date`) = YEAR(CURDATE()) 
                        AND MONTH(`date`) = MONTH(CURDATE())
                        AND warehouse IN ($imploded_warehouse_ids)
                ");
                $stock_stmt->bind_param("s", $product_id);
            }

            $stock_stmt->execute();
            $stock_result = $stock_stmt->get_result();

            while ($stock_row = $stock_result->fetch_assoc()) {
                $total_capital = floatval($stock_row['capital']);
                $category_capital += $total_capital;
                $category_qty += 1;
            }
        }

        $rowz[] = '<tr>
            <td><b>' . htmlspecialchars(ucwords(strtolower($c_category_name))) . '</b></td>
            <td class="text-end"><b>₱' . number_format($category_capital, 2) . '</b></td>
            <td class="text-end"><b>' . number_format($category_qty) . '</b></td>
        </tr>';

        // ▶️ Supplier breakdown
        $supplier_query = "
            SELECT 
                s.hashed_id AS supplier_id,
                s.supplier_name, 
                SUM(st.capital) AS total_supplier_capital,
                COUNT(*) AS supplier_qty
            FROM stocks st
            JOIN product p ON p.hashed_id = st.product_id
            JOIN supplier s ON s.hashed_id = st.supplier
            WHERE p.category = ? 
                AND st.item_status = 0
                AND YEAR(st.date) = YEAR(CURDATE())
                AND MONTH(st.date) = MONTH(CURDATE())";

        if ($selected_wh && $api_warehouse_id) {
            $supplier_query .= " AND st.warehouse = ?";
        } else {
            $supplier_query .= " AND st.warehouse IN ($imploded_warehouse_ids)";
        }

        $supplier_query .= " GROUP BY st.supplier";

        $supplier_stmt = $conn->prepare($supplier_query);
        if ($selected_wh && $api_warehouse_id) {
            $supplier_stmt->bind_param("ss", $c_category_id, $api_warehouse_id);
        } else {
            $supplier_stmt->bind_param("s", $c_category_id);
        }

        $supplier_stmt->execute();
        $supplier_result = $supplier_stmt->get_result();

        while ($supplier = $supplier_result->fetch_assoc()) {
            $rowz[] = '<tr>
                <td class="ps-4 text-muted fs-11">↳ ' .  htmlspecialchars($supplier['supplier_name']) . '</td>
                <td class="text-end text-muted fs-11">' . number_format($supplier['total_supplier_capital'], 2) . '</td>
                <td class="text-end text-muted fs-11">' . number_format($supplier['supplier_qty']) . '</td>
            </tr>';

            // ▶️ Products breakdown
            $product_details_query = "
                SELECT 
                    p.description,
                    b.brand_name,
                    SUM(st.capital) AS total_capital,
                    COUNT(*) AS product_qty
                FROM stocks st
                JOIN product p ON p.hashed_id = st.product_id
                JOIN brand b ON b.hashed_id = p.brand
                WHERE st.supplier = ?
                    AND p.category = ?
                    AND st.item_status = 0
                    AND YEAR(st.date) = YEAR(CURDATE())
                    AND MONTH(st.date) = MONTH(CURDATE())";

            if ($selected_wh && $api_warehouse_id) {
                $product_details_query .= " AND st.warehouse = ?";
            } else {
                $product_details_query .= " AND st.warehouse IN ($imploded_warehouse_ids)";
            }

            $product_details_query .= " GROUP BY p.hashed_id, b.hashed_id";

            $product_details_stmt = $conn->prepare($product_details_query);
            if ($selected_wh && $api_warehouse_id) {
                $product_details_stmt->bind_param("sss", $supplier['supplier_id'], $c_category_id, $api_warehouse_id);
            } else {
                $product_details_stmt->bind_param("ss", $supplier['supplier_id'], $c_category_id);
            }

            $product_details_stmt->execute();
            $product_details_result = $product_details_stmt->get_result();

            while ($product = $product_details_result->fetch_assoc()) {
                $rowz[] = '<tr>
                    <td class="ps-5 text-muted fs-11">- ↳ ' . htmlspecialchars($product['description'] . ' ' . $product['brand_name']) . '</td>
                    <td class="text-end text-muted fs-11">' . number_format($product['total_capital'], 2) . '</td>
                    <td class="text-end text-muted fs-11">' . number_format($product['product_qty']) . '</td>
                </tr>';
            }
        }
    }
}

$tables = '<tr>
        <th class="label">PREPARED BY:</th><td class="value">' . htmlspecialchars($user_fullname) . '</td>
        <th class="label">Date:</th><td class="value">' . date('F j, Y') . '</td>
        <th class="label">Warehouse:</th><td class="value">' . $warehouses_names . '</td>
    </tr>';

$html = "
    <html>
    <head>
        <style>
            body {
                font-family: Arial, sans-serif;
                color: #333;
                margin: 0;
                padding: 0;
                padding-top: 50px;
                text-align: center;
            }
            h1 {
                font-size: 24px;
                margin-top: 20px;
                text-align: center;
                color: #2c3e50;
                font-weight: bold;
                text-transform: uppercase;
            }
            .meta-table {
                width: 100%;
                margin: 20px 0;
                border-collapse: collapse;
                font-size: 10px;
            }
            .meta-table th,
            .meta-table td {
                padding: 8px 12px;
                text-align: left;
                border: 1px solid #ddd;
            }
            .meta-table th {
                background-color: #f4f6f6;
                font-weight: bold;
                color: #2c3e50;
            }
            table.container {
                width: 100%;
                border-collapse: collapse;
                font-size: 10px;
                margin-top: 30px;
            }
            table.container th,
            table.container td {
                padding: 8px;
                border: 1px solid #ddd;
            }
            table.container th {
                background-color: #3498db;
                color: #fff;
                font-weight: bold;
                font-size: 12px;
            }
            table.container tr:nth-child(even) {
                background-color: #f9f9f9;
            }
            table.container tr:hover {
                background-color: #f1f1f1;
            }
            .text-end {
                text-align: right;
            }
            .text-muted {
                color: #666;
            }
            .fs-11 {
                font-size: 7px;
            }
            .ps-4 {
                padding-left: 8px;
            }
            .ps-5 {
                padding-left: 12px;
            }
            .footer {
                font-size: 10px;
                margin-top: 40px;
                color: #7f8c8d;
            }
            .report-header {
                font-size: 10px;
                color: #2c3e50;
                margin: 10px 0;
            }
            .report-header strong {
                font-weight: bold;
            }
            .report-header .info-item {
                margin-right: 15px;
            }
        </style>
    </head>
    <body>
        <h1>Inventory Report for the Month of " . date('F') . "</h1>
        <div class='report-header'>
            <span class='info-item'><strong>Prepared by:</strong> " . htmlspecialchars($user_fullname) . "</span>
            <span class='info-item'><strong>Date:</strong> " . date('F j, Y') . "</span>
            <span class='info-item'><strong>Warehouse:</strong> " . $warehouses_names . "</span>
        </div>
        <table class='container'>
            <thead>
                <tr>
                    <th style='text-align: left;'>Category</th>
                    <th style='text-align: right;'>Total Unit Cost</th>
                    <th style='text-align: right;'>Quantity</th>
                </tr>
            </thead>
            <tbody>
                " . implode('', array_merge($rowz)) . "
            </tbody>
        </table>
        <div class='footer'>
            <p>This report was automatically generated by the system. All data is based on the current month's records.</p>
        </div>
    </body>
    </html>";
    

// Generate PDF
$mpdf = new \Mpdf\Mpdf([
    'format' => [210, 297], // 58mm x 30mm
    'margin_left' => 0,
    'margin_right' => 0,
    'margin_top' => 0,
    'margin_bottom' => 0,
]);

$mpdf->WriteHTML($html);

$fileName = preg_replace('/[^A-Za-z0-9_\-]/', '_', "$productDescription - $brandName - $categoryName") . '.pdf';
header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="' . $fileName . '"');
$mpdf->Output($fileName, 'D');
exit;

// If PDF is not generated, return JSON
echo json_encode($response);
exit;
?>
