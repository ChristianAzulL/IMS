<?php
include "database.php";
include "on_session.php";

// Check if the form was submitted via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // Sanitize the brand name
    $brandName = filter_input(INPUT_POST, 'brand_name', FILTER_SANITIZE_STRING);

    // Check if brand name is empty
    if (empty($brandName)) {
        echo "<script>alert('brand name cannot be empty.'); window.history.back();</script>";
        exit;
    }


    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO brand (brand_name, `date`, user_id) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $brandName, $currentDateTime, $user_id);

    // Execute the query
    if ($stmt->execute()) {
        header("Location: ../brand/?success=true");
    } else {
        header("Location: ../brand/?success=false");
    }

    // Close connections
    $stmt->close();
    $conn->close();

} else {
    // Redirect back if accessed without POST
    header("Location: ../brand.php");
    exit;
}
?>
