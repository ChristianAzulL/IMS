<?php 
require_once "../config/database.php";
require_once "../config/on_session.php";

// Local defective returns
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
        echo $row['description'] . ", " , $row['supplier_name'] . ", " . $row['local_international'] , ", " . $row['total_amount'] . "<br>";
    }
}


$header_for_this  = "D"
// International delivery failed returns
$returned_dF_query = "
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
    WHERE r.supplier_type = 'International' AND r.fault_type = 'DELIVERY FAILED'
    GROUP BY p.id, s.product_id, p.description
    ORDER BY sup.local_international, w.warehouse_name ASC
";
$returned_dF_res = $conn->query($returned_dF_query);

if ($returned_dF_res && $returned_dF_res->num_rows > 0) {
    while ($row = $returned_dF_res->fetch_assoc()) {
        echo $row['description'] . ", " , $row['supplier_name'] . ", " . $row['local_international'] , ", " . $row['total_amount'] . "<br>";
    }
}
