<?php
// Start a session
session_start();

// Include database configuration (adjust this file to your setup)
include('config/db_config.php');

// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Get email and password from the form
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';

    // Validate input
    if (!empty($email) && !empty($password)) {

        // Prepare and execute a query to find the user by email
        $stmt = $conn->prepare('SELECT * FROM users WHERE email = ? LIMIT 1');
        $stmt->bind_param('s', $email); // 's' specifies the variable type => 'string'
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Fetch the user data
            $user = $result->fetch_assoc();

            // Verify the password
            if (password_verify($password, $user['password'])) {
                // Password is correct, set session variables
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['email'] = $user['email'];

                // Respond with a success message
                echo json_encode(['status' => 'success', 'message' => 'Login successful']);
            } else {
                // Invalid password
                echo json_encode(['status' => 'error', 'message' => 'Invalid email or password']);
            }
        } else {
            // Email not found in the database
            echo json_encode(['status' => 'error', 'message' => 'Invalid email or password']);
        }

        // Close the statement
        $stmt->close();
    } else {
        // If inputs are empty
        echo json_encode(['status' => 'error', 'message' => 'Please fill out both fields']);
    }
} else {
    // If request is not POST, return an error
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
}

// Close the database connection
$conn->close();
?>
