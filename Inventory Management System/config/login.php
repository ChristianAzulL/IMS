<?php
include "database.php";

header('Content-Type: application/json'); // Ensure response is JSON

// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get and sanitize input values
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';

    // Basic validation
    if (empty($email) || empty($password)) {
        echo json_encode(['success' => false, 'message' => 'Email and password are required']);
        exit;
    }

    // Hash the password with SHA-256
    $hashedPassword = hash('sha256', $password);

    // Check the connection
    if ($conn->connect_error) {
        echo json_encode(['success' => false, 'message' => 'Database connection failed']);
        exit;
    }

    // Prepare and execute the query
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? AND user_pw = ?");
    $stmt->bind_param("ss", $email, $hashedPassword);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if a user record was found
    if ($result->num_rows > 0) {
        // Login successful
        session_start();
        $row = $result->fetch_assoc();
        $_SESSION['position_id'] = $row['user_position'];
        $position_id = $_SESSION['position_id'];
        $_SESSION['user_id'] = $row['hashed_id'];
        $_SESSION['full_name'] = $row['user_fname'] . " " . $row['user_lname'];
        $_SESSION['pfp'] = $row['pfp'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['birth_date'] = $row['birth_date'];
        $_SESSION['warehouse_ids'] = $row['warehouse_access'];
        $upos_query = "SELECT position_name, access FROM user_position WHERE hashed_id = '$position_id'";
        $upos_result = $conn->query($upos_query);
        $upos_row = $upos_result->fetch_assoc();
        $_SESSION['position_name'] = $upos_row['position_name'];
        $_SESSION['access'] = $upos_row['access'];

        echo json_encode(['success' => true]);
    } else {
        // Login failed
        echo json_encode(['success' => false, 'message' => 'Invalid email or password']);
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
} else {
    // Invalid request method
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>
