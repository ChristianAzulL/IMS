<?php
// Include your database connection file (adjust according to your project structure)
require_once 'database.php'; // Make sure to replace this with your actual DB connection file

// Start the session (if you need session data for user authentication)
session_start();

// Check if 'user_id' is passed and valid
if (isset($_POST['user_id']) && !empty($_POST['user_id'])) {
    // Get user_id and password (in this case, we're using a fixed password "123")
    $user_id = $_POST['user_id'];
    $password = '123'; // Hardcoded password (for demonstration)

    // Hash the password using SHA-256
    $hashed_password = hash('sha256', $password);

    // Prepare the SQL query to update the user's password
    $sql = "UPDATE users SET user_pw = ? WHERE hashed_id = ?";

    // Prepare the statement
    if ($stmt = $conn->prepare($sql)) {
        // Bind parameters
        $stmt->bind_param("ss", $hashed_password, $user_id);

        // Execute the query
        if ($stmt->execute()) {
            // Send success response
            $response = [
                'success' => true,
                'message' => 'Password has been reset successfully!'
            ];
        } else {
            // Send failure response
            $response = [
                'success' => false,
                'message' => 'Failed to reset password. Please try again.'
            ];
        }

        // Close the statement
        $stmt->close();
    } else {
        // Send failure response if SQL preparation fails
        $response = [
            'success' => false,
            'message' => 'Error preparing the database query.'
        ];
    }
} else {
    // Send failure response if 'user_id' is missing or invalid
    $response = [
        'success' => false,
        'message' => 'Invalid or missing user ID.'
    ];
}

// Close the database connection
$conn->close();

// Return the JSON response
echo json_encode($response);
?>
