<?php
include "../config/database.php";

// Calculate the start and end datetime of the current week
$startOfWeek = date('Y-m-d 00:00:00', strtotime('monday this week'));
$endOfWeek = date('Y-m-d 23:59:59', strtotime('sunday this week'));

// Query to fetch total sales for the current week
$query = "
    SELECT SUM(oc.sold_price) AS weekly_sales
    FROM outbound_content oc
    INNER JOIN outbound_logs ol ON oc.hashed_id = ol.hashed_id
    WHERE ol.date_sent BETWEEN '$startOfWeek' AND '$endOfWeek'
";

$result = $conn->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $weekly_sales = $row['weekly_sales'] ?? 0; // Default to 0 if NULL
} else {
    $weekly_sales = 0;
}

// Output the total sales as JSON
echo json_encode(['weekly_sales' => $weekly_sales]);

$conn->close();
?>