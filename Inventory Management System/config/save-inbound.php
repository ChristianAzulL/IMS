<?php
require '../config/database.php';
require '../config/on_session.php';
header('Content-Type: application/json'); // Ensure response is JSON

$response = ["status" => "error", "message" => "Something went wrong!"]; // Default error response

// Function to generate a unique 12-digit number
function generateUniqueKey($conn) {
    do {
        $uniqueKey = random_int(100000000000, 999999999999); // Generate 12-digit number
        $query = "SELECT COUNT(*) as count FROM inbound_logs WHERE unique_key = '$uniqueKey'";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
    } while ($row['count'] > 0); // Repeat if the number already exists

    return $uniqueKey;
}

$unique_key = generateUniqueKey($conn);
$_SESSION['unique_key'] = $unique_key;

$currentDateTime = $_SESSION['inbound_received_date'] ?? date('Y-m-d H:i:s');


$po_id = $_SESSION['inbound_po_id'];
$batch_code = "PObatch-" . $po_id;
$po_query = "SELECT po.warehouse, po.supplier, w.warehouse_name 
             FROM purchased_order po 
             LEFT JOIN warehouse w ON w.hashed_id = po.warehouse 
             WHERE po.id='$po_id' LIMIT 1";
$po_result = $conn->query($po_query);
if($row = $po_result->fetch_assoc()){
    $inbound_warehouse = $row['warehouse']; 
    $inbound_warehouse_name = $row['warehouse_name'];
    $supplier = $row['supplier'];
}


$update_po = "UPDATE purchased_order SET `status` = 1, date_received = '$currentDateTime' WHERE id = '$po_id'";
if ($conn->query($update_po) === TRUE) {
    $insert_inbound = "INSERT INTO inbound_logs 
                       (po_id, supplier, date_received, user_id, warehouse, unique_key) 
                       VALUES ('$po_id', '$supplier', '$currentDateTime', '$user_id', '$inbound_warehouse', '$unique_key')";

    if ($conn->query($insert_inbound) === TRUE) {
        $inbound_id = $conn->insert_id;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            foreach ($_POST['barcode'] as $index => $barcode) {
                $qty_received = $_POST['qty'][$index];
                $unit_price = (float)$_POST['unit_amount'][$index];
                $subtotal = $qty_received * $unit_price;

                $product_query = "SELECT hashed_id FROM product WHERE parent_barcode = '$barcode' LIMIT 1";
                $product_res = $conn->query($product_query);
                $row = $product_res->fetch_assoc();
                $product_id = $row['hashed_id'];
                
                $stock_query = "SELECT barcode_extension 
                                FROM stocks 
                                WHERE parent_barcode='$barcode' AND product_id = '$product_id' 
                                ORDER BY barcode_extension DESC LIMIT 1";
                $stock_res = $conn->query($stock_query);

                if ($stock_res->num_rows > 0) {
                    $row = $stock_res->fetch_assoc();
                    $chan = $row['barcode_extension'];
                } else {
                    $chan = 1;
                }
                for($i = 1; $i <= $qty_received; $i++){
                    $extension = $chan + $i;
                    $unique_barcode = $barcode . "-" . $extension;

                    $insert_stock = "INSERT INTO stocks 
                                    (item_status, inbound_id, unique_barcode, barcode_extension, product_id, parent_barcode, 
                                    batch_code, capital, warehouse, supplier, `date`, user_id, unique_key) 
                                    VALUES 
                                    (0, '$inbound_id', '$unique_barcode', '$extension', '$product_id', '$barcode', 
                                    '$batch_code', '$unit_price', '$inbound_warehouse', '$supplier', '$currentDateTime', '$user_id', '$unique_key')";

                    if ($conn->query($insert_stock) === TRUE) {
                        $stock_timeline = "INSERT INTO stock_timeline 
                                        (unique_barcode, title, `action`, `date`, user_id) 
                                        VALUES 
                                        ('$unique_barcode', 'INBOUND', 'Product was inbounded to $inbound_warehouse_name', '$currentDateTime', '$user_id')";

                        if ($conn->query($stock_timeline) === TRUE) {
                            $logs = "INSERT INTO logs 
                                    (title, action, date, user_id) 
                                    VALUES 
                                    ('INBOUND', 'PO-$po_id has been successfully inbounded to $inbound_warehouse_name. Created inbound reference no.: $inbound_id', '$currentDateTime', '$user_id')";

                            if ($conn->query($logs) === TRUE) {
                                $update_po = "UPDATE purchased_order SET `status` = 1, date_received = '$currentDateTime' WHERE id = '$po_id'";
                                if($conn->query($update_po) === TRUE ){
                                    $response = ["status" => "success", "message" => "Inbound items saved successfully!"];
                                    unset($_SESSION['inbound_po_id'], $_SESSION['inbound_received_date'], $_SESSION['po_list'], $_SESSION['success']);
                                }
                            }
                        }
                    }
                }
            }

            $conn->close();
            $_SESSION['success'] = 'Inbound items saved successfully!';
        }
    }
}
echo json_encode($response);
exit;
