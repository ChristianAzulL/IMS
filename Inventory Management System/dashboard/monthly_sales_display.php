<div class="card py-3 mb-3">
    <div class="card-body py-3">
        <div class="row g-0">
            <?php 
            $stats = [
                ["title" => "Warehouses", "value" => "15,450", "change" => "21.8%", "icon_class" => "text-primary"],
                ["title" => "Users", "value" => "1,054", "change" => "21.8%", "icon_class" => "text-warning"],
                ["title" => "Customers", "value" => "145.65", "change" => "21.8%", "icon_class" => "text-success"]
            ];

            foreach ($stats as $index => $stat) {
                $borderClass = ($index < count($stats) - 1) ? "border-end" : "border-end-md-0";
                $paddingClass = ($index > 0) ? "ps-md-3" : "";
                echo "
                <div class='col-6 col-md-4 border-200 border-bottom $borderClass pb-4 $paddingClass'>
                    <h6 class='pb-1 text-700'>{$stat['title']}</h6>
                    <p class='font-sans-serif lh-1 mb-1 fs-7'>{$stat['value']}</p>
                    <div class='d-flex align-items-center'>
                        <h6 class='fs-10 text-500 mb-0'>13,675</h6>
                        <h6 class='fs-11 ps-3 mb-0 {$stat['icon_class']}'>
                            <span class='me-1 fas fa-caret-up'></span>{$stat['change']}
                        </h6>
                    </div>
                </div>
                ";
            }
            ?>
        </div>
    </div>
</div>

<?php 
// Get the current and previous year
$current_year = date('Y');
$previous_year = $current_year - 1;

// Initialize variables for sales data
$last_year_sales = 0;
$current_year_sales = 0;

// Query to get the outbound sales grouped by year
$monthly_outbound_sales_query = "
    SELECT YEAR(date_sent) AS year, SUM(sold_price) AS total_outbound_sale 
    FROM outbound_logs ol 
    JOIN outbound_content oc ON ol.hashed_id = oc.hashed_id
    WHERE YEAR(date_sent) IN ($previous_year, $current_year)
    AND warehouse IN ($imploded_warehouse_ids)
    GROUP BY YEAR(date_sent)
    ORDER BY YEAR(date_sent) ASC
";

$monthly_outbound_sales_res = $conn->query($monthly_outbound_sales_query);

if ($monthly_outbound_sales_res->num_rows > 0) {
    while ($row = $monthly_outbound_sales_res->fetch_assoc()) {
        if ($row['year'] == $previous_year) {
            $last_year_sales = $row['total_outbound_sale'];
        } elseif ($row['year'] == $current_year) {
            $current_year_sales = $row['total_outbound_sale'];
        }
    }
} 
?>

<div class="card">
    <div class="card-header">
        <div class="row flex-between-center g-0">
            <div class="col-auto">
                <h6 class="mb-0">Monthly Outbound Sales</h6>
            </div>
            <div class="col-auto d-flex">
                <div class="form-check mb-0 d-flex">
                    <input class="form-check-input form-check-input-primary" id="ecommerceLastMonth" type="checkbox" checked>
                    <label class="form-check-label ps-2 fs-11 text-600 mb-0" for="ecommerceLastMonth">
                        Current Year<span class="text-1100 d-none d-md-inline">: ₱<?php echo number_format($last_year_sales, 2);?></span>
                    </label>
                </div>
                <div class="form-check mb-0 d-flex ps-0 ps-md-3">
                    <input class="form-check-input ms-2 form-check-input-warning opacity-75" id="ecommercePrevYear" type="checkbox" checked>
                    <label class="form-check-label ps-2 fs-11 text-600 mb-0" for="ecommercePrevYear">
                        Prev Year<span class="text-1100 d-none d-md-inline">: ₱<?php echo number_format($current_year_sales, 2);;?></span>
                    </label>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body pe-xxl-0">
        <div class="echart-line-total-sales-ecommerce" 
            data-echart-responsive="true" 
            data-options='{"optionOne":"ecommerceLastMonth","optionTwo":"ecommercePrevYear"}'>
        </div>
    </div>
</div>
