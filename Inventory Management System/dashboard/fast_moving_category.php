<div class="text-center bg-white" id="fast-cat-container">
    <div id="fast-cat-spinner" class="spinner-border spinner-border-sm text-primary" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
</div>
<div id="fast-cat"></div>


<script>
    $(document).ready(function () {
        // Show spinner on page load
        $('#fast-cat-spinner').show();

        // Wait 2 seconds, then load content
        setTimeout(function () {
            $('#fast-cat').load('fast-cat.php?wh=<?php echo $dashboard_wh; ?>', function () {
                // Hide spinner after content loads
                $('#fast-cat-spinner').hide();
            });
        }, 2000);
    });
</script>

