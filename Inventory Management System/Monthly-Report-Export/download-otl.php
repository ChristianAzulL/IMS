<?php 
require_once "../config/database.php";
require_once "../config/on_session.php";

// Set CSV headers for download
header('Content-Type: text/csv');
header('Content-Disposition: attachment;filename="warehouse_report.csv"');

// Open output stream
$output = fopen('php://output', 'w');

// Write CSV column headers
fputcsv($output, ['WAREHOUSE', 'ORDER NUMBER', 'ORDER LINE ID', 'CUSTOMER', 'DESCRIPTION', 'BRAND', 'CATEGORY', 'OUTBOUND REF #', 'PLATFORM', 'SOLD AMOUNT']);
$grand_total = 0;
$start_date = $_GET['start'];
$end_date = $_GET['end'];

$query = "SELECT 
            oc.unique_barcode,
            p.description,
            b.brand_name,
            c.category_name,
            s.outbound_id,
            lp.logistic_name,
            ol.order_num,
            ol.order_line_id,
            ol.customer_fullname,
            oc.sold_price,
            w.warehouse_name
          FROM outbound_content oc
          LEFT JOIN stocks s ON s.unique_barcode = oc.unique_barcode 
          LEFT JOIN outbound_logs ol ON ol.hashed_id = oc.hashed_id 
            AND s.outbound_id = ol.hashed_id
          LEFT JOIN product p ON p.hashed_id = s.product_id
          LEFT JOIN brand b ON b.hashed_id = p.brand
          LEFT JOIN category c ON c.hashed_id = p.category
          LEFT JOIN warehouse w ON w.hashed_id = s.warehouse
          LEFT JOIN logistic_partner lp ON lp.hashed_id = ol.platform
          WHERE oc.status != 1
          AND ol.date_sent BETWEEN '$start_date' AND '$end_date'
          ORDER BY ol.warehouse, w.warehouse_name";

$res = $conn->query($query);

if ($res->num_rows > 0) {
    while ($row = $res->fetch_assoc()) {
        $uniqueBarcode     = $row['unique_barcode'];
        $description       = $row['description'];
        $brandName         = $row['brand_name'];
        $categoryName      = $row['category_name'];
        $outboundId        = $row['outbound_id'];
        $logisticName      = $row['logistic_name'];
        $orderNum          = $row['order_num'];
        $orderLineId       = $row['order_line_id'];
        $customerFullname  = $row['customer_fullname'];
        $soldPrice         = $row['sold_price'];
        $warehouseName     = $row['warehouse_name'];

        $grand_total += $soldPrice;

        // Write each row to CSV
        fputcsv($output, [$warehouseName, $orderNum, $orderLineId, $customerFullname, $uniqueBarcode, $description, $brandName, $categoryName, $outboundId, $logisticName, $soldPrice]);
    }
    fputcsv($output, ["GRAND TOTAL","","","","","","","","","",$grand_total]);
}

// Close output
fclose($output);
exit;
