<?php
include "../config/database.php";
include "../config/on_session.php";

// Get the current and previous year
$current_year = date('Y');
$previous_year = $current_year - 1;

// Initialize an associative array for sales data
$sales_data = [];

// Query to get the outbound sales grouped by year and month
$monthly_outbound_sales_query = "SELECT YEAR(date_sent) AS year, MONTH(date_sent) AS month, SUM(sold_price) AS total_outbound_sale 
                                FROM outbound_logs ol 
                                JOIN outbound_content oc ON ol.hashed_id = oc.hashed_id
                                WHERE YEAR(date_sent) IN ($previous_year, $current_year)
                                GROUP BY YEAR(date_sent), MONTH(date_sent)
                                ORDER BY YEAR(date_sent) DESC, MONTH(date_sent) DESC";

$monthly_outbound_sales_res = $conn->query($monthly_outbound_sales_query);
if ($monthly_outbound_sales_res->num_rows > 0) {
    while ($row = $monthly_outbound_sales_res->fetch_assoc()) {
        $year = $row['year'];
        $month = date('F', mktime(0, 0, 0, $row['month'], 1)); // Convert numeric month to full name
        $sales_data[$year][$month] = $row['total_outbound_sale'];
    }
}

// Display the results
foreach (["$previous_year" => "last year", "$current_year" => "current year"] as $year => $label) {
    if (isset($sales_data[$year])) {
        foreach ($sales_data[$year] as $month => $sale) {
            echo strtolower($month) . " $label outbound_sale: " . $sale . "\n";
        }
    }
}
?>
