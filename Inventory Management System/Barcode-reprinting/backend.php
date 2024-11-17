<?php
// Include database connection file
require '../config/database.php'; // Make sure this file establishes a connection to your database
$sql = "SELECT 
            p.description, 
            b.brand_name, 
            c.category_name 
        FROM 
            product p 
        LEFT JOIN 
            brand b ON b.hashed_id = p.brand 
        LEFT JOIN 
            category c ON c.hashed_id = p.category";

$result = $conn->query($sql);

$products = [];
while ($row = $result->fetch_assoc()) {
    $products[] = $row;
}

header('Content-Type: application/json');
echo json_encode($products);

$conn->close();
?>