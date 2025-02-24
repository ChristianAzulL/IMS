<?php
include "../config/database.php";

// Get the start of the week based on system settings (Sunday or Monday)
$startOfWeek = date('Y-m-d 00:00:00', strtotime('this week')); // Start of the week
$today = date('Y-m-d 23:59:59'); // Today's date

// Query to fetch total sales per day from the start of the week till today
$query = "
    SELECT DATE(ol.date_sent) AS sale_date, SUM(oc.sold_price) AS daily_sales
    FROM outbound_content oc
    INNER JOIN outbound_logs ol ON oc.hashed_id = ol.hashed_id
    WHERE ol.date_sent BETWEEN '$startOfWeek' AND '$today'
    GROUP BY DATE(ol.date_sent)
    ORDER BY sale_date
";

$result = $conn->query($query);

$weekly_sales = 0;
$sales_data = [
    'weekly_sales' => 0,
    'sales' => []
];

// Initialize sales array with zero values for each day from the start of the week till today
$start = new DateTime($startOfWeek);
$end = new DateTime(date('Y-m-d 23:59:59', strtotime('sunday this week')));
$interval = new DateInterval('P1D');
$daterange = new DatePeriod($start, $interval, $end);


foreach ($daterange as $date) {
    $dayName = strtolower($date->format('l')); // e.g., 'sunday', 'monday'
    $sales_data['sales'][$dayName] = 0;
}

// Process query results and update sales_data
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $dayName = strtolower(date('l', strtotime($row['sale_date'])));
        $sales_data['sales'][$dayName] = $row['daily_sales'];
        $weekly_sales += $row['daily_sales'];
    }
}

// Update weekly sales total
$sales_data['weekly_sales'] = $weekly_sales;

// Output the JSON
echo json_encode($sales_data);

$conn->close();
?>
