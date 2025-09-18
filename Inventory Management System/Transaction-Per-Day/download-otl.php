<?php
require_once "../config/database.php";
require_once "../config/on_session.php";

header('Content-Type: text/csv; charset=UTF-8');
header('Content-Disposition: attachment; filename="warehouse_report.csv"');

// Output stream
$output = fopen('php://output', 'w');

// Add BOM for Excel UTF-8
fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));

// Column headers
fputcsv($output, [
    'WAREHOUSE','ORDER NUMBER','ORDER LINE ID','CUSTOMER','DESCRIPTION',
    'BRAND','CATEGORY','OUTBOUND REF #','PLATFORM','SOLD AMOUNT','STAFF','SIGNATURE'
]);

$start_date = $_GET['start'];
$end_date   = $_GET['end'];
$wh_id      = $_GET['wh'];

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
            w.warehouse_name,
            u.user_fname,
            u.user_lname
          FROM outbound_content oc
          LEFT JOIN stocks s ON s.unique_barcode = oc.unique_barcode 
          LEFT JOIN outbound_logs ol ON ol.hashed_id = oc.hashed_id 
            AND s.outbound_id = ol.hashed_id
          LEFT JOIN product p ON p.hashed_id = s.product_id
          LEFT JOIN brand b ON b.hashed_id = p.brand
          LEFT JOIN category c ON c.hashed_id = p.category
          LEFT JOIN warehouse w ON w.hashed_id = s.warehouse
          LEFT JOIN logistic_partner lp ON lp.hashed_id = ol.platform
          LEFT JOIN users u ON u.hashed_id = ol.user_id
          WHERE oc.status IN (0.1)
          AND ol.date_sent BETWEEN '$start_date' AND '$end_date'
          AND ol.warehouse = '$wh_id'
          ORDER BY ol.warehouse, w.warehouse_name";

$res = $conn->query($query);

if ($res->num_rows > 0) {
    while ($row = $res->fetch_assoc()) {
        $staff = $row['user_fname']." ".$row['user_lname'];
        fputcsv($output, [
            $row['warehouse_name'],
            $row['order_num'],
            $row['order_line_id'],
            $row['customer_fullname'],
            $row['description'],
            $row['brand_name'],
            $row['category_name'],
            $row['outbound_id'],
            $row['logistic_name'],
            $row['sold_price'],
            $staff,
            '' // blank signature column
        ]);
    }
}

fclose($output);
exit;
