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
                <?php include "monthly_sales_display.php";?>
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
