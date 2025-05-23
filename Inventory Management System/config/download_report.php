<?php 
error_reporting(E_ALL);
ini_set('max_execution_time', 300);
ini_set('memory_limit', '4G');
ini_set('display_errors', 1); 

include "database.php";
include "on_session.php";
require_once '../../vendor/autoload.php'; // Load mPDF

$response = array('success' => false, 'message' => 'Something went wrong.');

$selected_wh = $_GET['select_warehouse'] ?? null;
$user_warehouse_ids = $user_warehouse_ids ?? [];
$productDescription = $productDescription ?? 'Product';
$brandName = $brandName ?? 'Brand';
$categoryName = $categoryName ?? 'Category';

$quoted_warehouse_ids = array_map(function ($id) use ($conn) {
    return "'" . $conn->real_escape_string(trim($id)) . "'";
}, $user_warehouse_ids);
$imploded_warehouse_ids = implode(",", $quoted_warehouse_ids);

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
    $stmt = $conn->prepare("SELECT warehouse_name FROM warehouse WHERE hashed_id IN ($imploded_warehouse_ids)");
    $stmt->execute();
    $result = $stmt->get_result();
    $warehouse_names = [];

    while ($row = $result->fetch_assoc()) {
        $warehouse_names[] = $row['warehouse_name'];
    }

    $warehouses_names = empty($warehouse_names) ? "No warehouses found" : implode(', ', $warehouse_names);
}

$category_query = "SELECT category_name, hashed_id FROM category ORDER BY category_name ASC";
$category_res = $conn->query($category_query);

$rowz = [];
$grand_total_capital = 0;
$grand_total_qty = 0;

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
                $grand_total_capital += $total_capital;
                $grand_total_qty += 1;
            }
        }

        // CATEGORY ROW — blue background
        $rowz[] = '<tr style="background-color:#eaf2f8;">
            <td><b>' . htmlspecialchars(ucwords(strtolower($c_category_name))) . '</b></td>
            <td class="text-end"><b>₱' . number_format($category_capital, 2) . '</b></td>
            <td class="text-end"><b>' . number_format($category_qty) . '</b></td>
        </tr>';

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

        $supplier_query .= $selected_wh && $api_warehouse_id 
            ? " AND st.warehouse = ?" 
            : " AND st.warehouse IN ($imploded_warehouse_ids)";

        $supplier_query .= " GROUP BY st.supplier";

        $supplier_stmt = $conn->prepare($supplier_query);
        $selected_wh && $api_warehouse_id
            ? $supplier_stmt->bind_param("ss", $c_category_id, $api_warehouse_id)
            : $supplier_stmt->bind_param("s", $c_category_id);

        $supplier_stmt->execute();
        $supplier_result = $supplier_stmt->get_result();

        while ($supplier = $supplier_result->fetch_assoc()) {
            // SUPPLIER ROW — green background
            $rowz[] = '<tr style="background-color:#e8f8f5;">
                <td class="ps-4 text-muted fs-11"><b>↳ ' .  htmlspecialchars($supplier['supplier_name']) . '</b></td>
                <td class="text-end text-muted fs-11"><b>' . number_format($supplier['total_supplier_capital'], 2) . '</b></td>
                <td class="text-end text-muted fs-11"><b>' . number_format($supplier['supplier_qty']) . '</b></td>
            </tr>';

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

            $product_details_query .= $selected_wh && $api_warehouse_id 
                ? " AND st.warehouse = ?" 
                : " AND st.warehouse IN ($imploded_warehouse_ids)";
                
            $product_details_query .= " GROUP BY p.hashed_id, b.hashed_id";

            $product_details_stmt = $conn->prepare($product_details_query);
            $selected_wh && $api_warehouse_id
                ? $product_details_stmt->bind_param("sss", $supplier['supplier_id'], $c_category_id, $api_warehouse_id)
                : $product_details_stmt->bind_param("ss", $supplier['supplier_id'], $c_category_id);

            $product_details_stmt->execute();
            $product_details_result = $product_details_stmt->get_result();

            while ($product = $product_details_result->fetch_assoc()) {
                // PRODUCT ROW — yellow background
                $rowz[] = '<tr style="background-color:#fef9e7;">
                    <td class="ps-5 text-muted fs-11">- ↳ ' . htmlspecialchars($product['description'] . ' ' . $product['brand_name']) . '</td>
                    <td class="text-end text-muted fs-11">' . number_format($product['total_capital'], 2) . '</td>
                    <td class="text-end text-muted fs-11">' . number_format($product['product_qty']) . '</td>
                </tr>';
            }
        }
    }
}

// Grand Total row
$rowz[] = '<tr style="background-color:#f4f6f6;">
    <td><b>Grand Total</b></td>
    <td class="text-end"><b>₱' . number_format($grand_total_capital, 2) . '</b></td>
    <td class="text-end"><b>' . number_format($grand_total_qty) . '</b></td>
</tr>';

$html = "
    <html>
    <head>
        <style>
            body {
                font-family: Arial, sans-serif;
                color: #333;
                margin: 0;
                padding: 50px 20px 20px 20px;
                text-align: center;
            }
            h1 {
                font-size: 24px;
                margin-top: 20px;
                color: #2c3e50;
                font-weight: bold;
                text-transform: uppercase;
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
                " . implode('', $rowz) . "
            </tbody>
        </table>
        <div class='footer'>
            <p>This report was automatically generated by the system. All data is based on the current month's records.</p>
        </div>
    </body>
    </html>";

$mpdf = new \Mpdf\Mpdf([
    'format' => [210, 297],
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
?>
