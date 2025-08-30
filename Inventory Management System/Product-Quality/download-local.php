<?php 
require_once "../config/database.php";
require_once "../config/on_session.php";

// Set headers to force download
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename="returns_report.csv"');

// Open output stream
$output = fopen('php://output', 'w');

// 1. RETURNED AS DEFECTIVE
fputcsv($output, ["1","RETURNED AS DEFECTIVE"]);
fputcsv($output, ["ITEM","SUPPLIER","LOCAL/IMPORT","QTY","TOTAL AMOUNT"]);

$returned_def_query = "
    SELECT
        p.id,
        p.description,
        sup.supplier_name,
        sup.local_international,
        s.capital,
        COUNT(s.product_id) AS total_qty_of_item,
        SUM(s.capital) AS total_amount,
        w.warehouse_name
    FROM `returns` r 
    LEFT JOIN stocks s ON s.unique_barcode = r.unique_barcode
    LEFT JOIN product p ON p.hashed_id = s.product_id
    LEFT JOIN supplier sup ON sup.hashed_id = s.supplier
    LEFT JOIN warehouse w ON w.hashed_id = s.warehouse
    WHERE r.supplier_type = 'Local' AND r.fault_type = 'DEFECTIVE'
    GROUP BY p.id, s.product_id, p.description
    ORDER BY sup.local_international, w.warehouse_name ASC
";
$returned_def_res = $conn->query($returned_def_query);

if ($returned_def_res && $returned_def_res->num_rows > 0) {
    while ($row = $returned_def_res->fetch_assoc()) {
        fputcsv($output, [
            "",
            $row['description'],
            $row['supplier_name'],
            $row['local_international'],
            $row['total_qty_of_item'],
            $row['total_amount']
        ]);
    }
}

// 2. DELIVERY FAILED
fputcsv($output, []); // blank line for separation
fputcsv($output, ["2","DELIVERY FAILED"]);
fputcsv($output, ["ITEM","PLATFORM","QTY","PRICE"]);

$returned_dF_query = "
    SELECT
        p.id,
        p.description,
        sup.supplier_name,
        sup.local_international,
        s.capital,
        COUNT(s.product_id) AS total_qty_of_item,
        SUM(s.capital) AS total_amount,
        w.warehouse_name,
        lp.logistic_name AS platform
    FROM `returns` r 
    LEFT JOIN stocks s ON s.unique_barcode = r.unique_barcode
    LEFT JOIN product p ON p.hashed_id = s.product_id
    LEFT JOIN supplier sup ON sup.hashed_id = s.supplier
    LEFT JOIN warehouse w ON w.hashed_id = s.warehouse
    LEFT JOIN outbound_content oc ON oc.unique_barcode = s.unique_barcode
    LEFT JOIN outbound_logs ol ON ol.hashed_id = oc.hashed_id
    LEFT JOIN logistic_partner lp ON lp.hashed_id = ol.platform
    WHERE r.supplier_type = 'International' AND r.fault_type = 'DELIVERY FAILED'
    GROUP BY p.id, s.product_id, p.description
    ORDER BY sup.local_international, w.warehouse_name ASC
";
$returned_dF_res = $conn->query($returned_dF_query);

if ($returned_dF_res && $returned_dF_res->num_rows > 0) {
    while ($row = $returned_dF_res->fetch_assoc()) {
        fputcsv($output, [
            "",
            $row['description'],
            $row['platform'],
            $row['total_qty_of_item'],
            $row['total_amount']
        ]);
    }
}

// Close output (not really needed, but good practice)
fclose($output);
exit;
