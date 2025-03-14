<?php

// Check if API data is available
if ($json_data === false) {
    die("Error: Unable to fetch data from API.");
}

// Initialize brand count array
$brand_count = [];
$current_week_start = date("Y-m-d", strtotime("monday this week"));
$current_week_end = date("Y-m-d", strtotime("sunday this week"));

// Process outbound data
foreach ($data as $outbound) {
    $outbound_date = substr($outbound['outbound_date'], 0, 10); // Extract date only
    
    if ($outbound_date >= $current_week_start && $outbound_date <= $current_week_end) {
        foreach ($outbound['products'] as $product) {
            $brand_name = $product['brand_name'];

            if (!isset($brand_count[$brand_name])) {
                $brand_count[$brand_name] = [
                    'brand_name' => $brand_name,
                    'total_sold' => 0
                ];
            }
            
            $brand_count[$brand_name]['total_sold']++;
        }
    }
}

// Sort brands by total_sold in descending order
usort($brand_count, function ($a, $b) {
    return $b['total_sold'] - $a['total_sold'];
});

// Limit to top 50 brands
$fast_moving_brands = array_slice($brand_count, 0, 50);
?>

<div id="tableExample3" data-list='{"valueNames":["brand_id","brand_brand","brand_qty"],"page":5,"pagination":true}'>

    <div class="row">
        <div class="col-12 mb-3 ms-3 mt-3">
            <h6>Top 50 Fast Moving by Brands (This Week)</h6>
        </div>
    </div>

    <div class="row justify-content-end g-0">
        <div class="col-auto col-sm-5 mb-3">
            <form>
                <div class="input-group">
                    <input class="form-control form-control-sm shadow-none search" type="search" placeholder="Search..." aria-label="search" />
                    <div class="input-group-text bg-transparent">
                        <span class="fa fa-search fs-10 text-600"></span>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <div class="table-responsive scrollbar">
        <table class="table table-bordered table-striped fs-10 mb-0">
            <thead class="bg-200">
                <tr>
                    <th class="text-900" data-sort="brand_id">#</th>
                    <th class="text-900" data-sort="brand_brand">Brand</th>
                    <th class="text-900 text-end" data-sort="brand_qty">Sold Qty</th>
                </tr>
            </thead>
            <tbody class="list">
                <?php $rank = 1; ?>
                <?php foreach ($fast_moving_brands as $brand): ?>
                    <tr>
                        <td><?= $rank; ?></td>
                        <td><?= htmlspecialchars($brand['brand_name']); ?></td>
                        <td class='text-end'><?= $brand['total_sold']; ?></td>
                    </tr>
                    <?php $rank++; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center mt-3">
        <button class="btn btn-sm btn-falcon-default me-1" type="button" title="Previous" data-list-pagination="prev">
            <span class="fas fa-chevron-left"></span>
        </button>
        <ul class="pagination mb-0"></ul>
        <button class="btn btn-sm btn-falcon-default ms-1" type="button" title="Next" data-list-pagination="next">
            <span class="fas fa-chevron-right"></span>
        </button>
    </div>
</div>