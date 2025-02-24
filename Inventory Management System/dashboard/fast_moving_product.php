<?php

// Fetch the JSON data from outbound API
function fetchAPI($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $response = curl_exec($ch);
    curl_close($ch);
    return $response;
}

$json_data = fetchAPI('http://localhost/IMS/Inventory%20Management%20System/API/outbound.php');

if ($json_data === false) {
    die("Error: Unable to fetch data from API.");
}

// Debug: Log the raw JSON response
file_put_contents("debug_outbound.json", $json_data);

// Attempt to decode JSON
$data = json_decode($json_data, true);

if ($data === null || !is_array($data)) {
    die("Error: JSON decoding failed - " . json_last_error_msg() . "<br>Raw Output: <pre>" . htmlspecialchars($json_data) . "</pre>");
}

$products_count = [];
$current_week_start = date("Y-m-d", strtotime("monday this week"));
$current_week_end = date("Y-m-d", strtotime("sunday this week"));

// Loop through outbound data
foreach ($data as $outbound) {
    $outbound_date = substr($outbound['outbound_date'], 0, 10); // Extract date only
    
    if ($outbound_date >= $current_week_start && $outbound_date <= $current_week_end) {
        foreach ($outbound['products'] as $product) {
            $product_id = $product['product_id'];
            
            if (!isset($products_count[$product_id])) {
                $products_count[$product_id] = [
                    'description' => $product['description'],
                    'brand_name' => $product['brand_name'],
                    'category_name' => $product['category_name'],
                    'sold_price' => $product['sold_price'],
                    'capital' => $product['capital'],
                    'total_sold' => 0
                ];
            }
            
            $products_count[$product_id]['total_sold']++;
        }
    }
}

// Sort products by total_sold in descending order
usort($products_count, function($a, $b) {
    return $b['total_sold'] - $a['total_sold'];
});

// Limit to top 50
$fast_moving_products = array_slice($products_count, 0, 50);

?>

<div class="row">
    <div class="col-12 mb-3 ms-3 mt-3"><h6>Fast Moving Products(this week)</h6></div>
</div>
<div id="tableExample3" data-list='{"valueNames":["id","description","brand","category","sold","capital","total_sold"],"page":5,"pagination":true}'>
  <div class="row justify-content-end g-0">
    <div class="col-auto col-sm-5 mb-3">
      <form>
        <div class="input-group"><input class="form-control form-control-sm shadow-none search" type="search" placeholder="Search..." aria-label="search" />
          <div class="input-group-text bg-transparent"><span class="fa fa-search fs-10 text-600"></span></div>
        </div>
      </form>
    </div>
  </div>
  <div class="table-responsive scrollbar">
    <table class="table table-bordered table-striped fs-10 mb-0">
      <thead class="bg-200">
        <tr>
          <th class="text-900 sort" data-sort="id">#</th>
          <th class="text-900 sort" data-sort="description">Description</th>
          <th class="text-900 sort" data-sort="brand">Brand</th>
          <th class="text-900 sort" data-sort="category">Category</th>
          <th class="text-900 sort" data-sort="sold">Sold Price</th>
          <th class="text-900 sort" data-sort="capital">Capital</th>
          <th class="text-900 sort" data-sort="total_sold">Sold Qty</th>
        </tr>
      </thead>
      <tbody class="list">
<?php
foreach ($fast_moving_products as $product_id => $product) {
    echo "<tr>";
    echo "<td class='id'>{$product_id}</td>";
    echo "<td class='description'>{$product['description']}</td>";
    echo "<td class='brand'>{$product['brand_name']}</td>";
    echo "<td class='category'>{$product['category_name']}</td>";
    echo "<td class='sold'>{$product['sold_price']}</td>";
    echo "<td class='capital'>{$product['capital']}</td>";
    echo "<td class='total_sold'>{$product['total_sold']}</td>";
    echo "</tr>";
}
?>
      </tbody>
    </table>
  </div>
  <div class="d-flex justify-content-center mt-3">
    <button class="btn btn-sm btn-falcon-default me-1" type="button" title="Previous" data-list-pagination="prev"><span class="fas fa-chevron-left"></span></button>
    <ul class="pagination mb-0"></ul>
    <button class="btn btn-sm btn-falcon-default ms-1" type="button" title="Next" data-list-pagination="next"><span class="fas fa-chevron-right"> </span></button>
  </div>
</div>
