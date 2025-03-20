<?php 
// Uncomment the following line if you want to restrict this section to testers
// if($user_position_name === "tester" || $user_position_name === "Tester") {

// Determine the time of day
$hour = date("H"); // Get the current hour in 24-hour format
if ($hour >= 5 && $hour < 12) {
    $time_name = "Morning";
} elseif ($hour >= 12 && $hour < 17) {
    $time_name = "Afternoon";
} elseif ($hour >= 17 && $hour < 21) {
    $time_name = "Evening";
} else {
    $time_name = "Midnight";
}
?>

<div class="row g-3 mb-3">
    <div class="col-xxl-6 col-xl-12">
        <div class="row g-3">
            <div class="col-12">
                <?php include "outbound.php"; ?>
            </div>
            <div class="col-lg-12">
                <?php include "fast_moving_product.php";?>
            </div>
        </div>
    </div>
    
    <div class="col-xxl-6 col-xl-12">
        <div class="row">
            <div class="col-lg-12">
                <div class="row g-3 mb-3">
                    <?php include "weekly_sales.php"; ?>
                    <?php include "total_order.php"; ?>
                </div>
            </div>
            
            <div class="col-lg-12">
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
                                            <h6 class='fs-11 ps-3 mb-0 {$stat['icon_class']}'><span class='me-1 fas fa-caret-up'></span>{$stat['change']}</h6>
                                        </div>
                                    </div>
                                ";
                            }
                            ?>
                        </div>
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-header">
                        <div class="row flex-between-center g-0">
                            <div class="col-auto">
                                <h6 class="mb-0">Total Sales</h6>
                            </div>
                            <div class="col-auto d-flex">
                                <div class="form-check mb-0 d-flex">
                                    <input class="form-check-input form-check-input-primary" id="ecommerceLastMonth" type="checkbox" checked>
                                    <label class="form-check-label ps-2 fs-11 text-600 mb-0" for="ecommerceLastMonth">Last Month<span class="text-1100 d-none d-md-inline">: $32,502.00</span></label>
                                </div>
                                <div class="form-check mb-0 d-flex ps-0 ps-md-3">
                                    <input class="form-check-input ms-2 form-check-input-warning opacity-75" id="ecommercePrevYear" type="checkbox" checked>
                                    <label class="form-check-label ps-2 fs-11 text-600 mb-0" for="ecommercePrevYear">Prev Year<span class="text-1100 d-none d-md-inline">: $46,018.00</span></label>
                                </div>
                            </div>
                            <div class="col-auto">
                                <div class="dropdown font-sans-serif btn-reveal-trigger">
                                    <button class="btn btn-link text-600 btn-sm dropdown-toggle dropdown-caret-none btn-reveal" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="fas fa-ellipsis-h fs-11"></span>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end border py-2">
                                        <a class="dropdown-item" href="#">View</a>
                                        <a class="dropdown-item" href="#">Export</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item text-danger" href="#">Remove</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pe-xxl-0">
                        <div class="echart-line-total-sales-ecommerce" data-echart-responsive="true" data-options='{"optionOne":"ecommerceLastMonth","optionTwo":"ecommercePrevYear"}'></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xxl-12 col-xl-12">
        <?php include "inventory.php";?>
    </div>
</div>

<?php 
// Uncomment the following line to close the conditional statement
// }
?>
