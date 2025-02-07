<?php
include "database.php";
include "on_session.php";

if (isset($_GET['type']) && isset($_GET['barcode'])) {
    $type = $_GET['type'];
    $barcode = $_GET['barcode'];
    
    $set_status = ($type === "replace") ? 2 : 1;
    $action = ($type === "replace") ? "item is replaced." : "item is refunded.";

    // Use prepared statements to prevent SQL injection
    $update = $conn->prepare("UPDATE rts_content SET `status` = ? WHERE unique_barcode = ?");
    $update->bind_param("is", $set_status, $barcode);

    if ($update->execute()) {
        $stock_timeline = $conn->prepare("INSERT INTO stock_timeline (unique_barcode, title, `action`, `date`, user_id) VALUES (?, 'RTS', ?, ?, ?)");
        $stock_timeline->bind_param("sssi", $barcode, $action, $currentDateTime, $user_id);

        if ($stock_timeline->execute()) {
            // Update action message for logs
            $log_action = "$barcode " . ($type === "replace" ? "is replaced." : "is refunded.");

            $logs = $conn->prepare("INSERT INTO logs (title, `action`, `date`, user_id) VALUES ('Return to Supplier', ?, ?, ?)");
            $logs->bind_param("ssi", $log_action, $currentDateTime, $user_id);
            $logs->execute();
        }
    }

    // Close prepared statements
    $update->close();
    $stock_timeline->close();
    $logs->close();
}

$conn->close();
?>
