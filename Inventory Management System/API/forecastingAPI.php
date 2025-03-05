<?php
include "../config/database.php";
include "../config/on_session.php";

$sql = "SELECT p.hashed_id AS product_id, 
               p.description, 
               b.brand_name, 
               c.category_name, 
               ol.date_sent, 
               ol.order_num, 
               ol.order_line_id, 
               p.parent_barcode, 
               w.warehouse_name, 
               w.hashed_id AS warehouse_id, 
               oc.unique_barcode 
        FROM outbound_content oc
        LEFT JOIN outbound_logs ol ON ol.hashed_id = oc.hashed_id
        LEFT JOIN stocks s ON s.unique_barcode = oc.unique_barcode
        LEFT JOIN warehouse w ON w.hashed_id = s.warehouse
        LEFT JOIN product p ON p.hashed_id = s.product_id
        LEFT JOIN brand b ON b.hashed_id = p.brand
        LEFT JOIN category c ON c.hashed_id = p.category";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $previous7days =0;
    $previous30days = 0;
    $pre
    while ($row = $result->fetch_assoc()) {
        $product_id = $row['product_id'];
        $product_description = $row['description'];
        $brand_name = $row['brand_name'];
        $category_name = $row['category_name'];
        $date_sent = $row['date_sent'];
        $order_num = $row['order_num'];
        $order_line_id = $row['order_line_id'];
        $parent_barcode = $row['parent_barcode'];
        $warehouse_name = $row['warehouse_name'];
        $warehouse_id = $row['warehouse_id'];
        $unique_barcode = $row['unique_barcode'];

        this query can display multiple $product_id but only 1 unique $unique_barcode. how can I count 


        
        // You can now use these variables as needed
    }
}
?>
