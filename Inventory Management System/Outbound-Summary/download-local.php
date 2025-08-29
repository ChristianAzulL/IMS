<?php 
require_once "../config/database.php";
require_once "../config/on_session.php";

/**
 * ================================
 *  INBOUND IMPORTS (International & Local)
 * ================================
 * Exports data into CSV instead of echoing HTML
 */

$warehouse_id = null;
$warehouse_name = null;

if (isset($_GET['warehouse_id'])) {
    $warehouse_id = $_GET['warehouse_id'];
    
    $get_wh_name = "SELECT warehouse_name FROM warehouse WHERE hashed_id = '$warehouse_id' LIMIT 1";
    $get_wh_res = $conn->query($get_wh_name);
    if ($get_wh_res->num_rows > 0) {
        $row = $get_wh_res->fetch_assoc();
        $warehouse_name = $row['warehouse_name'];
    }
}

// Set headers so browser downloads it as a CSV
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename="outbound_summary - ' . $warehouse_name . '.csv"');

// Open output stream
$output = fopen('php://output', 'w');

// Section 1: Imports (International)
fputcsv($output, ['1', 'IMPORTS', 'QTY', 'TOTAL AMOUNT']);

$inbound_import_query = "
    SELECT 
        sup.supplier_name, 
        COUNT(oc.unique_barcode) AS total_imports, 
        SUM(oc.sold_price) AS total_imports_amount
    FROM supplier sup
    LEFT JOIN stocks s ON s.supplier = sup.hashed_id
    LEFT JOIN outbound_content oc ON oc.unique_barcode = s.unique_barcode
    LEFT JOIN outbound_logs ol ON ol.hashed_id = oc.hashed_id
    WHERE sup.local_international = 'International' AND s.warehouse = '$warehouse_id'
      AND ol.date_sent BETWEEN LAST_DAY(CURDATE() - INTERVAL 2 MONTH) + INTERVAL 1 DAY 
                      AND NOW() AND ol.status IN (0,6)
    GROUP BY sup.supplier_name
";

$inbound_import_res = $conn->query($inbound_import_query);
if ($inbound_import_res->num_rows > 0) {
    while ($row = $inbound_import_res->fetch_assoc()) {
        fputcsv($output, ["",$row['supplier_name'], $row['total_imports'], $row['total_imports_amount']]);
    }
}

// Section 2: Locals
fputcsv($output, ['2', 'LOCALS', 'QTY', 'TOTAL AMOUNT']);

$inbound_local_query = "
   SELECT 
        sup.supplier_name, 
        COUNT(oc.unique_barcode) AS total_locals, 
        SUM(oc.sold_price) AS total_local_amount
    FROM supplier sup
    LEFT JOIN stocks s ON s.supplier = sup.hashed_id
    LEFT JOIN outbound_content oc ON oc.unique_barcode = s.unique_barcode
    LEFT JOIN outbound_logs ol ON ol.hashed_id = oc.hashed_id
    WHERE sup.local_international = 'Local' AND s.warehouse = '$warehouse_id'
      AND ol.date_sent BETWEEN LAST_DAY(CURDATE() - INTERVAL 2 MONTH) + INTERVAL 1 DAY 
                      AND NOW() AND ol.status IN (0,6)
    GROUP BY sup.supplier_name
";

$inbound_local_res = $conn->query($inbound_local_query);
if ($inbound_local_res->num_rows > 0) {
    while ($row = $inbound_local_res->fetch_assoc()) {
        fputcsv($output, ["",$row['supplier_name'], $row['total_locals'], $row['total_local_amount']]);
    }
}

// Close file
fclose($output);
exit;
?>
