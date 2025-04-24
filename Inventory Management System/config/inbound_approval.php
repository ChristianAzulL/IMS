<?php

header('Content-Type: application/json');

// Include your database connection file
require_once 'database.php';
require_once 'on_session.php';

if (isset($_POST['target_id']) && isset($_POST['response']) && isset($_POST['to_userid'])) {
    $unique_key = htmlspecialchars(filter_input(INPUT_POST, 'target_id', FILTER_SANITIZE_STRING));
    $response = htmlspecialchars(filter_input(INPUT_POST, 'response', FILTER_SANITIZE_STRING));
    $to_userid = filter_input(INPUT_POST, 'to_userid', FILTER_SANITIZE_STRING);
    $reason_raw = filter_input(INPUT_POST, 'reason_admin', FILTER_SANITIZE_STRING);
    $reason_admin = htmlspecialchars($user_fullname . '; ' . $reason_raw);


    if($response === "approve"){
        $response_value = "approved";
        $status_value = 3;
    } else {
        $response_value = "declined";
        $status_value = 2;
    }
    

    // Update inbound_logs
    $stmt1 = $conn->prepare("UPDATE inbound_logs SET `status` = ?, authorize_reason = ?, date_approved = ? WHERE unique_key = ?");
    $stmt1->bind_param("isss", $status_value, $reason_admin, $currentDateTime, $unique_key);

    if ($stmt1->execute()) {

        // If approved, update stocks
        if ($response === "approve") {
            $stmt2 = $conn->prepare("UPDATE stocks SET item_status = 8, batch_code = '-', barcode_extension = 0 WHERE unique_key = ?");
            $stmt2->bind_param("s", $unique_key);

            if (!$stmt2->execute()) {
                echo json_encode(['success' => false, 'message' => 'Failed to update stocks.']);
                exit;
            }
        }

        // Prepare notification message
        if ($response === "approve") {
            $notification_message = $user_fullname . ' approved your request to delete inbound with ref #: ' . $unique_key;
        } else {
            $notification_message = $user_fullname . ' declined your request to delete inbound with ref #: ' . $unique_key;
        }

        // Insert notification
        $stmt3 = $conn->prepare("INSERT INTO `notification` (title, `message`, `date`, to_userid, `status`) VALUES (?, ?, ?, ?, 0)");
        $title = 'Inbound delete request.';
        $stmt3->bind_param("ssss", $title, $notification_message, $currentDateTime, $to_userid);

        if ($stmt3->execute()) {

            // Insert log
            $log_action = 'Inbound Ref #: ' . $unique_key . ' has been ' . $response_value  . ' to be deleted by ' . $user_fullname . '.';
            $stmt4 = $conn->prepare("INSERT INTO logs (title, `action`, user_id,`date`) VALUES ('INBOUND APPROVAL', ?, ?, ?)");
            $stmt4->bind_param("sss", $log_action, $user_id, $currentDateTime);

            if ($stmt4->execute()) {
                echo json_encode(['success' => true, 'message' => 'Approved!']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to log the request.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to create notification.']);
        }

    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update inbound logs.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'failed!']);
}

$conn->close();

?>
