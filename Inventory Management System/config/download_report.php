<?php 
error_reporting(E_ALL);
ini_set('max_execution_time', 300);
ini_set('memory_limit', '4G');
ini_set('display_errors', 1); 

include "database.php";
include "on_session.php";

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
    if ($row = $result->fetch_assoc()) {
        $api_warehouse_name = $row['warehouse_name'];
        $api_warehouse_id = $row['hashed_id'];
    }
} else {
    $api_warehouse_id = null;
}

$category_query = "SELECT category_name, hashed_id FROM category ORDER BY category_name ASC";
$category_res = $conn->query($category_query);

$rows = [];
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

        // Category row
        $rows[] = [$c_category_name, '', '', '', number_format($category_capital, 2), number_format($category_qty)];

        // Supplier level
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
            $rows[] = ['', $supplier['supplier_name'], '', '', number_format($supplier['total_supplier_capital'], 2), number_format($supplier['supplier_qty'])];

            $product_details_query = "
                SELECT 
                    p.description,
                    p.parent_barcode,
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
                $rows[] = [
                    '', '', 
                    $product['description'] . ' ' . $product['brand_name'], 
                    $product['parent_barcode'], 
                    number_format($product['total_capital'], 2), 
                    number_format($product['product_qty'])
                ];
            }
        }
    }
}

// Grand total
$rows[] = ['Grand Total', '', '', '', number_format($grand_total_capital, 2), number_format($grand_total_qty)];

// CSV Output
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="inventory_report_' . date('Y_m') . '.csv"');
$output = fopen('php://output', 'w');

// Add header row
fputcsv($output, ['Category', 'Supplier', 'Item', 'Parent Barcode', 'Total Unit Cost', 'Quantity']);

foreach ($rows as $row) {
    fputcsv($output, $row);
}

fclose($output);
exit;
?>
