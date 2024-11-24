<?php
include "../config/database.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Use prepared statements to prevent SQL injection
    $query = "SELECT * FROM stocks WHERE product_id = ?";
    $stmt = $conn->prepare($query);

    if ($stmt === false) {
        die('Error preparing statement: ' . $conn->error);
    }

    $stmt->bind_param("s", $id); // assuming 'product_id' is a string, adjust the type if necessary
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo $row['unique_barcode'] . "<br>";
        }
    } else {
        echo "No data found for the given product ID.";
    }

    $stmt->close();
} else {
    echo "No product ID provided.";
}
?>
