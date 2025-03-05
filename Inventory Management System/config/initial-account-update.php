<?php
include "database.php"; // Ensure this file establishes a valid DB connection
include "on_session.php"; // Ensure this file initializes $user_id correctly

header('Content-Type: application/json');

if(isset($_GET['wizard'])){
    $wizard = $_GET['wizard'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if ($wizard === "password") {
            // Sanitize input
            $password = trim($_POST['password'] ?? '');
            if (empty($password)) {
                echo json_encode(["success" => false, "message" => "Password cannot be empty."]);
                exit;
            }

            // Hash password securely (use password_hash instead of SHA256)
            $hashedPassword = hash('sha256', $password);

            // Update the password in the database
            $stmt = $conn->prepare("UPDATE users SET user_pw = ? WHERE hashed_id = ?");
            if ($stmt->execute([$hashedPassword, $user_id])) {
                echo json_encode(["success" => true, "message" => "Password updated successfully."]);
            } else {
                echo json_encode(["success" => false, "message" => "Failed to update password."]);
            }
            exit;

        } elseif ($wizard === "pfp") {
            if (!isset($_FILES['pfp']) || $_FILES['pfp']['error'] !== UPLOAD_ERR_OK) {
                echo json_encode(["success" => false, "message" => "Invalid file upload."]);
                exit;
            }

            $uploadDir = "../../assets/img/";
            $fileTmpPath = $_FILES['pfp']['tmp_name'];
            $fileName = $_FILES['pfp']['name'];
            $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

            // Allowed file types
            $allowedExts = ['jpg', 'jpeg', 'png', 'gif'];
            if (!in_array($fileExt, $allowedExts)) {
                echo json_encode(["success" => false, "message" => "Invalid file format. Allowed: jpg, jpeg, png, gif."]);
                exit;
            }

            // Generate unique filename
            do {
                $newFileName = uniqid() . "." . $fileExt;
                $destinationPath = $uploadDir . $newFileName;
            } while (file_exists($destinationPath));

            // Move uploaded file
            if (move_uploaded_file($fileTmpPath, $destinationPath)) {
                // Save filename in the database
                $stmt = $conn->prepare("UPDATE users SET pfp = ? WHERE hashed_id = ?");
                if ($stmt->execute([$newFileName, $user_id])) {
                    echo json_encode(["success" => true, "message" => "Profile picture updated."]);
                } else {
                    echo json_encode(["success" => false, "message" => "Database update failed."]);
                }
            } else {
                echo json_encode(["success" => false, "message" => "File upload failed."]);
            }
            exit;
        }
    }
}
echo json_encode(["success" => false, "message" => "Invalid request."]);
?>
