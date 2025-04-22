<?php 

header('Content-Type: application/json');

include "database.php";
include "on_session.php";

if (isset($_GET['target_id'])) {
    $unique_key = $_GET['target_id'];

    // Update inbound_logs
    $stmt1 = $conn->prepare("UPDATE inbound_logs SET `status` = 1 WHERE unique_key = ?");
    $stmt1->bind_param("s", $unique_key);

    if ($stmt1->execute()) {

        // Insert notification
        $notification_message = $user_fullname . ' is requesting to delete inbound with ref #: ' . $unique_key;
        $stmt3 = $conn->prepare("INSERT INTO `notification` (title, `message`, `date`, `status`) VALUES (?, ?, ?, 0)");
        $title = 'Inbound delete request.';
        $stmt3->bind_param("sss", $title, $notification_message, $currentDateTime);

        if ($stmt3->execute()) {

            // Insert log entry
            $log_action = 'Inbound Ref #: ' . $unique_key . ' has been successfully requested to be deleted by ' . $user_fullname . '.';
            $stmt4 = $conn->prepare("INSERT INTO logs (title, action, user_id, date) VALUES ('INBOUND DELETE', ?, ?, ?)");
            $stmt4->bind_param("sss", $log_action, $user_id, $currentDateTime);

            if ($stmt4->execute()) {
                echo json_encode(['success' => true, 'message' => 'Waiting for approval!']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to log the request.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to create notification.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update inbound logs.']);
    }
}

$conn->close();
