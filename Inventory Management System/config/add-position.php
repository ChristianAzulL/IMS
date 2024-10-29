<?php
// Include your database connection file
include 'database.php';
include "on_session.php";

// Check if the form is submitted via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Sanitize and retrieve the position name
    $positionName = isset($_POST['position-name']) ? trim($_POST['position-name']) : '';
    
    // Retrieve selected access permissions and implode them into a comma-separated string
    $accessPermissions = isset($_POST['access']) ? implode(',', $_POST['access']) : '';

    // Check for empty fields (optional validation)
    if (empty($positionName)) {
        echo "Position name is required.";
        exit;
    }

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO user_position (position_name, access,`date`, user_id) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssi", $positionName, $accessPermissions, $currentDateTime,  $user_id);


    // Execute the statement and check for success
    if ($stmt->execute()) {
        // echo "Position added successfully!";
        // // Optionally, redirect to another page
        header("Location: ../Access-levels/?success=true");
    } else {
        // echo "Error: " . $stmt->error;
        header("Location: ../Access-levels/?success=false&m=$stmt->error");
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method.";
}
?>
