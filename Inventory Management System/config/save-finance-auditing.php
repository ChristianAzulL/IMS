<?php
include "../config/database.php";
include "../config/on_session.php";
header('Content-Type: application/json');

// Create finance_audit table if it doesn't exist
$conn->query("
    CREATE TABLE IF NOT EXISTS finance_audit (
        id INT AUTO_INCREMENT PRIMARY KEY,
        status VARCHAR(15),
        order_number VARCHAR(50),
        order_line_id VARCHAR(50),
        warehouse VARCHAR(50),
        client VARCHAR(50),
        paid_amount decimal(10,2),
        expected_amount decimal(10,2),
        user_id VARCHAR(100),
        date DATETIME DEFAULT CURRENT_TIMESTAMP
    )
");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach($_POST['order_num'] as $i => $orderNum){
        // Capture POST data
        $order_num     = $_POST['order_num'][$i] ?? null;
        $order_line    = $_POST['order_line'][$i] ?? null;
        $warehouse     = $_POST['warehouse'][$i] ?? null;
        $client        = $_POST['client'][$i] ?? null;
        $status        = $_POST['status'][$i] ?? null;
        $paid_amount   = $_POST['paid_amount'][$i] ?? null;
        $expect_amount = $_POST['expect_amount'][$i] ?? null;
        $csv_id        = $_POST['csv_id'][$i] ?? null;

        // Insert finance audit record
        $insert_data = "
            INSERT INTO finance_audit
                SET status = '$status',
                order_number = '$order_num',
                order_line_id = '$order_line',
                warehouse = '$warehouse',
                client = '$client',
                paid_amount = '$paid_amount',
                expected_amount = '$expect_amount',
                user_id = '$user_id',
                date = '$currentDateTime'
        ";

        if ($conn->query($insert_data) === TRUE) {
            // Update CSV auditing status
            $update_csv = "UPDATE csv_auditing SET status = 2 WHERE id = '$csv_id'";
            if ($conn->query($update_csv) === TRUE) {
                // Get hashed_id from outbound_logs
                $query_outbounds = "
                    SELECT hashed_id FROM outbound_logs 
                    WHERE order_num = '$order_num' 
                    AND order_line_id = '$order_line' 
                    AND customer_fullname = '$client' 
                    LIMIT 1
                ";
                $query_outbounds_result = $conn->query($query_outbounds);

                if ($query_outbounds_result->num_rows > 0) {
                    $row = $query_outbounds_result->fetch_assoc();
                    $outbound_id = $row['hashed_id'];

                    if ($status === "PAID") {
                        // Update outbound_logs and outbound_content
                        $update_outbound_log = "
                            UPDATE outbound_logs 
                            SET status = 0 
                            WHERE order_num = '$order_num' 
                            AND order_line_id = '$order_line' 
                            AND customer_fullname = '$client'
                        ";
                        if ($conn->query($update_outbound_log) === TRUE) {
                            $update_outbound_items = "
                                UPDATE outbound_content 
                                SET status = 0 
                                WHERE hashed_id = '$outbound_id'
                            ";
                            if ($conn->query($update_outbound_items) === TRUE) {
                                // Fetch barcodes from outbound_content
                                $query_outbound_contents = "
                                    SELECT unique_barcode 
                                    FROM outbound_content 
                                    WHERE hashed_id = '$outbound_id'
                                ";
                                $res_outbound_contents = $conn->query($query_outbound_contents);
                                if ($res_outbound_contents->num_rows > 0) {
                                    while ($row = $res_outbound_contents->fetch_assoc()) {
                                        $unique_barcode = $row['unique_barcode'];

                                        // Insert into stock_timeline
                                        $action = "Paid via finance auditing. The staff who processed it is " . $user_fullname;
                                        $insert_to_item_history = "
                                            INSERT INTO stock_timeline (unique_barcode, title, action, user_id, date) 
                                            VALUES (?, 'Outbound', ?, ?, ?)
                                        ";
                                        $stmt = $conn->prepare($insert_to_item_history);
                                        $stmt->bind_param("ssss", $unique_barcode, $action, $user_id, $currentDateTime);
                                        $stmt->execute();

                                        // Insert log
                                        $log_action = 'Outbound #' . $outbound_id . ' has been successfully paid via finance auditing.';
                                        $insert_logs = "
                                            INSERT INTO logs (title, action, user_id, date) 
                                            VALUES ('OUTBOUND', ?, ?, ?)
                                        ";
                                        $stmt = $conn->prepare($insert_logs);
                                        $stmt->bind_param("sss", $log_action, $user_id, $currentDateTime);
                                        $stmt->execute();
                                    }
                                }
                            }
                        }
                    }
                }
            }
            echo json_encode(['success' => true, 'message' => 'Records saved successfully.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Insert failed: ' . $conn->error]);
        }
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
