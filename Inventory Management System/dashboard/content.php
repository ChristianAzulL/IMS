<?php
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
    <?php 
    if(strpos($access, "dashboard_outbound")!==false || $user_position_name === "Administrator"){
    ?>
    <div class="col-xxl-6 col-xl-12">
        <div class="row g-3">
            <div class="col-12">
                <?php include "outbound.php"; ?>
            </div>
            <div class="col-lg-12">
                <?php include "fast_moving_product.php";?>
            </div>

            <div class="col-lg-12">
                <?php include "inbound_outbound.php";?>
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
    <?php 
    }
    if(strpos($access, "dashboard_inventory")!==false || $user_position_name === "Administrator"){
    ?>
    <div class="col-xxl-12 col-xl-12">
        <?php include "inventory.php";?>
    </div>
    <?php 
    }
    ?>
</div>




<script>
$(document).ready(function() {
    // Function to load the warehouse preview
    function loadWarehousePreview(warehouse) {
        if (warehouse) {
            $.get('dashboard-wh-preview.php', { warehouse: warehouse }, function(data) {
                $('#dashboard-wh-preview').html(data);
            }).fail(function() {
                $('#dashboard-wh-preview').html('Failed to load preview.');
            });
        }
    }

    // Get the initial selected warehouse value
    var initialWarehouse = $('#dashboard-wh').val();

    // Load the preview for the initially selected warehouse
    loadWarehousePreview(initialWarehouse);

    // When the user changes the warehouse, update the preview
    $('#dashboard-wh').on('change', function() {
        var warehouse = $(this).val();
        loadWarehousePreview(warehouse);
    });
});
</script>
