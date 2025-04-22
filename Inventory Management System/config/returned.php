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

        // Get rts_id from rts_content
        $get_rts_id = $conn->prepare("SELECT rts_id FROM rts_content WHERE unique_barcode = ?");
        $get_rts_id->bind_param("s", $barcode);
        $get_rts_id->execute();
        $get_rts_id->bind_result($rts_id);
        $get_rts_id->fetch();
        $get_rts_id->close();

        // Update status in rts_logs table
        if (!empty($rts_id)) {
            $update_logs = $conn->prepare("UPDATE rts_logs SET `status` = 1 WHERE id = ?");
            $update_logs->bind_param("i", $rts_id);
            $update_logs->execute();
            $update_logs->close();
        }

        // Insert into stock_timeline
        $stock_timeline = $conn->prepare("INSERT INTO stock_timeline (unique_barcode, title, `action`, `date`, user_id) VALUES (?, 'RTS', ?, ?, ?)");
        $stock_timeline->bind_param("sssi", $barcode, $action, $currentDateTime, $user_id);
        $stock_timeline->execute();
        $stock_timeline->close();

        // Insert into logs
        $log_action = "$barcode " . ($type === "replace" ? "is replaced." : "is refunded.");
        $logs = $conn->prepare("INSERT INTO logs (title, `action`, `date`, user_id) VALUES ('Return to Supplier', ?, ?, ?)");
        $logs->bind_param("ssi", $log_action, $currentDateTime, $user_id);
        $logs->execute();
        $logs->close();
    }

    $update->close();
}

$conn->close();
?>
