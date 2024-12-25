<?php
include('database.php');
include('on_session.php'); 

$outbound_id = $_SESSION['outbound_id'];
$warehouse_for_outbound = $_SESSION['warehouse_outbound'];
$warehouse_sql = "SELECT hashed_id FROM warehouse WHERE warehouse_name = '$warehouse_for_outbound' LIMIT 1";
$res = $conn->query($warehouse_sql);
if($res->num_rows>0){
    $row = $res->fetch_assoc();
    $warehouse = $row['hashed_id'];
}
$response = [
    'status' => 'error',
    'error' => 'Something went wrong.',
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customerName = isset($_POST['customer_name']) ? htmlspecialchars($_POST['customer_name']) : '';
    $platform = isset($_POST['platform']) ? htmlspecialchars($_POST['platform']) : '';
    $courier = isset($_POST['courier']) ? htmlspecialchars($_POST['courier']) : '';
    $orderNo = isset($_POST['order_no']) ? htmlspecialchars($_POST['order_no']) : '';
    $orderLineID = isset($_POST['order_line_id']) ? htmlspecialchars($_POST['order_line_id']) : '';
    $processedBy = isset($_POST['processed_by']) ? $_POST['processed_by'] : '';

    $barcodes = isset($_POST['barcode']) ? $_POST['barcode'] : [];
    $sellingPrices = isset($_POST['selling']) ? $_POST['selling'] : [];

    if (empty($customerName) || empty($platform) || empty($courier) || empty($orderNo) || empty($orderLineID)) {
        $response['error'] = 'All fields are required.';
        echo json_encode($response);
        exit;
    }

    if (empty($barcodes) || empty($sellingPrices) || count($barcodes) !== count($sellingPrices)) {
        $response['error'] = 'Barcodes and selling prices must be provided and match in number.';
        echo json_encode($response);
        exit;
    }

    $conn->begin_transaction();

    try {
        $orderSql = "INSERT INTO outbound_logs (date_sent, warehouse, user_id, customer_fullname, courier, platform, order_num, order_line_id, hashed_id) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $conn->prepare($orderSql);
        $stmt->bind_param("sssssssss", $currentDateTime, $warehouse, $user_id, $customerName, $courier, $platform, $orderNo, $orderLineID, $outbound_id);
        
        if ($stmt->execute()) {
            $orderID = $conn->insert_id;

            foreach ($barcodes as $key => $barcode) {
                $sellingPrice = $sellingPrices[$key];
                $itemSql = "INSERT INTO outbound_content (unique_barcode, sold_price, hashed_id) 
                            VALUES (?, ?, ?)";
                $itemStmt = $conn->prepare($itemSql);
                $itemStmt->bind_param("sss", $barcode, $sellingPrice, $outbound_id);
                
                if ($itemStmt->execute()) {
                    $update_stock = "UPDATE stocks SET item_status = 1, outbound_id = '$outbound_id', outbounded_by = '$user_id' WHERE unique_barcode = '$barcode'";
                    if ($conn->query($update_stock) === TRUE) {
                        $action = "Outbounded to Customer: " . $customerName;
                        $insert_to_item_history = "INSERT INTO stock_timeline SET unique_barcode = '$barcode', title = 'Outbound', `action` = '$action', user_id = '$user_id', `date` = '$currentDateTime'";
                        $conn->query($insert_to_item_history);
                    }
                } else {
                    throw new Exception("Failed to insert order item: " . $itemStmt->error);
                }
            }

            $log_action = 'Outbound #' . $outbound_id . ' has been successfully processed.';
            $insert_logs = "INSERT INTO logs SET title = 'OUTBOUND', `action` = '$log_action', user_id = '$user_id', `date` = '$currentDateTime'";
            $conn->query($insert_logs);

            $filePath = '../Outbound-form/' . $outbound_id . '.json';
            if (file_exists($filePath) && !unlink($filePath)) {
                throw new Exception("Failed to delete the file.");
            }

            $conn->commit();
            $response['status'] = 'success';
            $response['message'] = 'Order saved successfully.';
            unset($response['error']);
        } else {
            throw new Exception("Failed to insert order: " . $stmt->error);
        }
    } catch (Exception $e) {
        $conn->rollback();
        $response['error'] = 'Transaction failed: ' . $e->getMessage();
    }

    echo json_encode($response);
}
?>
