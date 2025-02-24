<?php
// Fetch JSON from API
$jsonData = file_get_contents('http://localhost/IMS/Inventory%20Management%20System/API/outbound.php'); // Adjust URL if needed

// Decode JSON
$outbounds = json_decode($jsonData, true);

// Check for errors
if (json_last_error() !== JSON_ERROR_NONE) {
    die("JSON Decode Error: " . json_last_error_msg());
}

// 1️⃣ Count total outbound transactions
$totalOutbound = count($outbounds);

// 2️⃣ Prepare weekly sum of sold_price for past 4 weeks
$weeklySales = [
    date('W', strtotime('-3 weeks')) => 0,
    date('W', strtotime('-2 weeks')) => 0,
    date('W', strtotime('-1 week'))  => 0,
    date('W')                        => 0, // Current week
];

// 3️⃣ Initialize latest week tracking
$latestWeek = 0;

foreach ($outbounds as $outbound) {
    $weekKey = date('W', strtotime($outbound['outbound_date'])); // Extract week number

    // Track the latest week
    if ($weekKey > $latestWeek) {
        $latestWeek = $weekKey;
    }

    // Calculate sales for the past 4 weeks
    if (isset($weeklySales[$weekKey])) {
        foreach ($outbound['products'] as $product) {
            $weeklySales[$weekKey] += floatval($product['sold_price']);
        }
    }
}
// 4️⃣ Convert week numbers to "Week X" format
$weekLabels = [];
$salesData = [];
$weekCount = 4;
foreach ($weeklySales as $week => $sales) {
    $weekLabels[] = "Week " . intval($week); // Use actual week number
    $salesData[] = $sales;
}

?>

<div class="card-body d-flex flex-column justify-content-end">
  <div class="row justify-content-between">

    <!-- Order Count -->
    <div class="col-auto align-self-end">
      <div class="fs-5 fw-normal font-sans-serif text-700 lh-1 mb-1">
        <?php echo number_format($totalOutbound); ?> <!-- Total outbound transactions -->
      </div>
    </div>

    <!-- Line Chart for Order Trends -->
    <div class="col-auto ps-0 mt-n4">
      <div 
        class="echart-default-total-order"
        data-echarts='{
          "tooltip": {
            "trigger": "axis",
            "formatter": "{b0} : {c0}"
          },
          "xAxis": {
            "data": <?php echo json_encode($weekLabels); ?> 
          },
          "series": [
            {
              "type": "line",
              "data": <?php echo json_encode($salesData); ?>, 
              "smooth": true,
              "lineStyle": { "width": 3 }
            }
          ],
          "grid": {
            "bottom": "2%",
            "top": "2%",
            "right": "10px",
            "left": "10px"
          }
        }'
        data-echart-responsive="true">
      </div>
    </div>

  </div>
</div>
