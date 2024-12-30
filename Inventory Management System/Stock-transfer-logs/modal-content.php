<?php
include "../config/database.php";

if (isset($_GET['id'])) {
    $getid = $conn->real_escape_string($_GET['id']);

    $query = "SELECT * FROM stock_transfer WHERE id = '$getid' LIMIT 1";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();

        $fromWarehouse = $row['from_warehouse'];
        $toWarehouse = $row['to_warehouse'] ?? null;
        $status = $row['status'];
        $fromUserId = $row['from_userid'];
        $receivedUserId = $row['received_userid'] ?? null;
        $dateSent = $row['date_out'];
        $dateReceived = $row['date_received'];
        $remarksSender = $row['remarks_sender'];

        // Get the warehouse names
        $fromWarehouseQuery = "SELECT warehouse_name FROM warehouse WHERE hashed_id = '$fromWarehouse' LIMIT 1";
        $fromWarehouseResult = $conn->query($fromWarehouseQuery);
        $fromWarehouseName = ($fromWarehouseResult && $fromWarehouseResult->num_rows > 0) ? $fromWarehouseResult->fetch_assoc()['warehouse_name'] : '<b class="text-danger">?!</b>';

        $toWarehouseName = '<b class="text-danger">?!</b>';
        if (!empty($toWarehouse)) {
            $toWarehouseQuery = "SELECT warehouse_name FROM warehouse WHERE hashed_id = '$toWarehouse' LIMIT 1";
            $toWarehouseResult = $conn->query($toWarehouseQuery);
            if ($toWarehouseResult && $toWarehouseResult->num_rows > 0) {
                $toWarehouseName = $toWarehouseResult->fetch_assoc()['warehouse_name'];
            }
        }

        // Get the user full names
        $fromUserQuery = "SELECT CONCAT(user_fname, ' ', user_lname) AS fullname FROM users WHERE hashed_id = '$fromUserId' LIMIT 1";
        $fromUserResult = $conn->query($fromUserQuery);
        $fromFullname = ($fromUserResult && $fromUserResult->num_rows > 0) ? $fromUserResult->fetch_assoc()['fullname'] : '<b class="text-danger">?!</b>';

        $receiverName = '<b class="text-danger">?!</b>';
        if (!empty($receivedUserId)) {
            $toUserQuery = "SELECT CONCAT(user_fname, ' ', user_lname) AS fullname FROM users WHERE hashed_id = '$receivedUserId' LIMIT 1";
            $toUserResult = $conn->query($toUserQuery);
            if ($toUserResult && $toUserResult->num_rows > 0) {
                $receiverName = $toUserResult->fetch_assoc()['fullname'];
            }
        }

        // Status badge
        $statusBadge = match ($status) {
            "pending" => '<span class="badge bg-primary">Pending</span>',
            "enroute" => '<span class="badge bg-warning">Enroute</span>',
            "received" => '<span class="badge bg-success">Received</span>',
            default => '<span class="badge bg-danger">Failed</span>',
        };
        
    } else {
        echo "<p>No record found for the provided ID.</p>";
    }
} else {
    echo "<p>ID parameter is missing.</p>";
}
?>
