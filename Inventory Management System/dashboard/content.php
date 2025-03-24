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

<div class="modal fade" id="firstModal" data-keyboard="false" tabindex="-1" aria-labelledby="scrollinglongcontentLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="scrollinglongcontentLabel">Modal title</h5><button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body modal-dialog modal-dialog-scrollable mt-0">
            <div id="modal-1-display"></div>
            </div>
            <div class="modal-footer"><button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button></div>
        </div>
    </div>
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
