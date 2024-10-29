<?php
include "database.php";
include "on_session.php";

// Check if the form was submitted via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // Sanitize the warehouse name
    $warehouseName = filter_input(INPUT_POST, 'warehouse-name', FILTER_SANITIZE_STRING);

    // Check if warehouse name is empty
    if (empty($warehouseName)) {
        echo "<script>alert('Warehouse name cannot be empty.'); window.history.back();</script>";
        exit;
    }


    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO warehouse (warehouse_name, `date`, user_id) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $warehouseName, $currentDateTime, $user_id);

    // Execute the query
    if ($stmt->execute()) {
        header("Location: ../Warehouses/?success=true");
    } else {
        header("Location: ../Warehouses/?success=false");
    }

    // Close connections
    $stmt->close();
    $conn->close();

} else {
    // Redirect back if accessed without POST
    header("Location: ../warehouse-list.php");
    exit;
}
?>
