<div class="text-center bg-white" id="slow-cat-container">
    <div id="slow-cat-spinner" class="spinner-border spinner-border-sm text-primary" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
</div>
<div id="slow-cat"></div>


<script>
    $(document).ready(function () {
        // Show spinner on page load
        $('#slow-cat-spinner').show();

        // Wait 2 seconds, then load content
        setTimeout(function () {
            $('#slow-cat').load('slow-cat.php?wh=<?php echo $dashboard_wh; ?>', function () {
                // Hide spinner after content loads
                $('#slow-cat-spinner').hide();
            });
        }, 2000);
    });
</script>

