<?php
require 'database.php'; // Include database connection
require 'on_session.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $filtered_input = [];

    // Filter input: Only process fields that have a name attribute
    foreach ($_POST as $key => $value) {
        if (!empty($key)) {
            $filtered_input[$key] = trim($value);
        }
    }

    // Check if necessary fields exist
    if (isset($filtered_input['barcode'], $filtered_input['amount'], $filtered_input['warehouse'])) {
        $barcode = $filtered_input['barcode'];
        $amount = floatval($filtered_input['amount']);
        $warehouse_return = $filtered_input['warehouse'];
        $outbound_id = $filtered_input['outbound_id'];

        // Insert return details
        $insert = "INSERT INTO `returns` (unique_barcode, amount, `date`, user_id, warehouse) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($insert);
        $stmt->bind_param("sdsss", $barcode, $amount, $currentDateTime, $user_id, $warehouse_return);

        if ($stmt->execute()) {
            // Insert into stock_timeline
            $item_logs = "INSERT INTO stock_timeline (unique_barcode, title, `action`, `date`, user_id) VALUES (?, 'PRODUCT RETURN', 'Product was returned.', ?, ?)";
            $stmt_logs = $conn->prepare($item_logs);
            $stmt_logs->bind_param("sss", $barcode, $currentDateTime, $user_id);

            if ($stmt_logs->execute()) {
                $update_stock_status = "UPDATE stocks SET item_status = 0 WHERE unique_barcode = ?";
                $stmt_update_stock_status = $conn->prepare($update_stock_status);
                $stmt_update_stock_status->bind_param("s", $barcode);
                $stmt_update_stock_status->execute();
                // Insert into logs
                $logs = "INSERT INTO logs (title, `action`, `date`, user_id) VALUES ('PRODUCT RETURN', ?, ?, ?)";
                $stmt_log = $conn->prepare($logs);
                $log_action = "$barcode was returned.";
                $stmt_log->bind_param("sss", $log_action, $currentDateTime, $user_id);

                if ($stmt_log->execute()) {
                    // Update outbound_logs to set status = 1
                    $update_outbound_logs = "UPDATE outbound_logs SET status = 1 WHERE hashed_id = ?";
                    $stmt_outbound_logs = $conn->prepare($update_outbound_logs);
                    $stmt_outbound_logs->bind_param("s", $outbound_id);
                    $stmt_outbound_logs->execute();

                    // Update outbound_content to set status = 1
                    $update_outbound_content = "UPDATE outbound_content SET status = 1 WHERE unique_barcode = ?";
                    $stmt_outbound_content = $conn->prepare($update_outbound_content);
                    $stmt_outbound_content->bind_param("s", $barcode);
                    $stmt_outbound_content->execute();

                    // Redirect to return logs page on success
                    header("Location: ../Return-logs/");
                    exit();
                }
            }
        }

        // Close statements
        $stmt->close();
        $stmt_logs->close();
        $stmt_log->close();
        $stmt_outbound_logs->close();
        $stmt_outbound_content->close();
    } else {
        echo "<script>alert('Missing required fields.'); window.history.back();</script>";
    }
}
?>
