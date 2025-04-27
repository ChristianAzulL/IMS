<?php
include "../config/database.php";
include "../config/on_session.php";

function json_response($data = null, $httpStatus = 200) {
    header_remove();
    http_response_code($httpStatus);
    header('Content-Type: application/json');
    echo json_encode($data);
    exit();
}

$inbound_outbound_data = [];

if (isset($_POST['date_between'])) {
    $date_between = $_POST['date_between']; // example: 01/04/25 to 30/04/25
    list($start_date, $end_date) = explode(' to ', $date_between);

    // Convert to MySQL format Y-m-d
    $start_date_mysql = DateTime::createFromFormat('d/m/y', $start_date)->format('Y-m-d');
    $end_date_mysql = DateTime::createFromFormat('d/m/y', $end_date)->format('Y-m-d');

    // Format for display (e.g., Jan 1, 2025)
    $start_date_display = DateTime::createFromFormat('d/m/y', $start_date)->format('M j, Y');
    $end_date_display = DateTime::createFromFormat('d/m/y', $end_date)->format('M j, Y');
    $date_label = "$start_date_display to $end_date_display";

    // Outbound query
    $outbound_query = "
    SELECT 
        SUM(oc.sold_price) AS total_outbound_sales,
        COUNT(oc.unique_barcode) AS outbound_qty
    FROM outbound_content oc
    LEFT JOIN outbound_logs ol ON ol.hashed_id = oc.hashed_id   
    WHERE oc.status = 0 AND DATE(ol.date_sent) BETWEEN '$start_date_mysql' AND '$end_date_mysql'
    ";

    $outbound_result = mysqli_query($conn, $outbound_query);

    if ($outbound_result && mysqli_num_rows($outbound_result) > 0) {
        $outbound_data = mysqli_fetch_assoc($outbound_result);
        $total_outbound_sales = $outbound_data['total_outbound_sales'] ?? 0;
        $outbound_qty = $outbound_data['outbound_qty'] ?? 0;
    } else {
        $total_outbound_sales = 0;
        $outbound_qty = 0;
    }

    // Inbound query
    $inbound_query = "
    SELECT 
        SUM(capital) AS total_unit_cost,
        COUNT(unique_barcode) AS inbound_qty
    FROM stocks
    WHERE DATE(date) BETWEEN '$start_date_mysql' AND '$end_date_mysql'
    ";

    $inbound_result = mysqli_query($conn, $inbound_query);

    if ($inbound_result && mysqli_num_rows($inbound_result) > 0) {
        $inbound_data = mysqli_fetch_assoc($inbound_result);
        $total_unit_cost = $inbound_data['total_unit_cost'] ?? 0;
        $inbound_qty = $inbound_data['inbound_qty'] ?? 0;
    } else {
        $total_unit_cost = 0;
        $inbound_qty = 0;
    }

} else {
    // Today's date
    $today_mysql = date('Y-m-d');
    $today_display = date('M j, Y');
    $date_label = $today_display;

    $today_formatted = date('M j, Y'); // example: "Apr 27, 2025"
    $date_label = $today_formatted;

    // Outbound query
    $outbound_query = "
    SELECT 
        SUM(oc.sold_price) AS total_outbound_sales,
        COUNT(oc.unique_barcode) AS outbound_qty
    FROM outbound_content oc
    LEFT JOIN outbound_logs ol ON ol.hashed_id = oc.hashed_id   
    WHERE oc.status = 0 AND DATE(ol.date_sent) = '$today_mysql'
    ";

    $outbound_result = mysqli_query($conn, $outbound_query);

    if ($outbound_result && mysqli_num_rows($outbound_result) > 0) {
        $outbound_data = mysqli_fetch_assoc($outbound_result);
        $total_outbound_sales = $outbound_data['total_outbound_sales'] ?? 0;
        $outbound_qty = $outbound_data['outbound_qty'] ?? 0;
    } else {
        $total_outbound_sales = 0;
        $outbound_qty = 0;
    }

    // Inbound query
    $inbound_query = "
    SELECT 
        SUM(capital) AS total_unit_cost,
        COUNT(unique_barcode) AS inbound_qty
    FROM stocks
    WHERE DATE(date) = '$today_mysql'
    ";

    $inbound_result = mysqli_query($conn, $inbound_query);

    if ($inbound_result && mysqli_num_rows($inbound_result) > 0) {
        $inbound_data = mysqli_fetch_assoc($inbound_result);
        $total_unit_cost = $inbound_data['total_unit_cost'] ?? 0;
        $inbound_qty = $inbound_data['inbound_qty'] ?? 0;
    } else {
        $total_unit_cost = 0;
        $inbound_qty = 0;
    }
}

// Final response array
$inbound_outbound_data = [
    'date' => $date_label,
    'outbound_qty' => (int)$outbound_qty,
    'outbound_sales' => (float)$total_outbound_sales,
    'inbound_qty' => (int)$inbound_qty,
    'inbound_cost' => (float)$total_unit_cost,
];

// Output JSON
json_response($inbound_outbound_data);
?>
