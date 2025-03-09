<?php


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

$category_count = [];
$current_week_start = date("Y-m-d", strtotime("monday this week"));
$current_week_end = date("Y-m-d", strtotime("sunday this week"));

// Loop through outbound data
foreach ($data as $outbound) {
    $outbound_date = substr($outbound['outbound_date'], 0, 10); // Extract date only
    
    if ($outbound_date >= $current_week_start && $outbound_date <= $current_week_end) {
        foreach ($outbound['products'] as $product) {
            $category_name = $product['category_name'];

            if (!isset($category_count[$category_name])) {
                $category_count[$category_name] = [
                    'category_name' => $category_name,
                    'total_sold' => 0
                ];
            }

            $category_count[$category_name]['total_sold']++;
        }
    }
}

// Sort categories by total_sold in descending order
usort($category_count, function($a, $b) {
    return $b['total_sold'] - $a['total_sold'];
});

// Limit to top 50
$fast_moving_categories = array_slice($category_count, 0, 50);

?>

<div id="tableExample3" data-list='{"valueNames":["cat_id","category_cat","cat_qty"],"page":5,"pagination":true}'>
<div class="row">
        <div class="col-12 mb-3 ms-3 mt-3">
            <h6>Top 50 Fast Moving by Category (This Week)</h6>
        </div>
    </div>
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
                <th class="text-900" data-sort="cat_id">#</th>
                <th class="text-900" data-sort="category_cat">Category</th>
                <th class="text-900 text-end" data-sort="cat_qty">Sold Qty</th>
            </tr>
        </thead>
        <tbody class="list">
<?php
$rank = 1;
foreach ($fast_moving_categories as $category) {
    echo "<tr>";
    echo "<td class='cat_id'>{$rank}</td>";
    echo "<td class='category_cat'>{$category['category_name']}</td>";
    echo "<td class='cat_qty text-end'>{$category['total_sold']}</td>";
    echo "</tr>";
    $rank++;
}
?></tbody>
</table>
</div>
<div class="d-flex justify-content-center mt-3"><button class="btn btn-sm btn-falcon-default me-1" type="button" title="Previous" data-list-pagination="prev"><span class="fas fa-chevron-left"></span></button>
<ul class="pagination mb-0"></ul><button class="btn btn-sm btn-falcon-default ms-1" type="button" title="Next" data-list-pagination="next"><span class="fas fa-chevron-right"> </span></button>
</div>
</div>