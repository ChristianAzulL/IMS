<div class="card h-100" id="slow-cat-container">
    <div class="card-header">
        <h6>top 10 Slow Moving Category</h6>
    </div>
    <div class="card-body text-center py-6">
        <!-- Load Button -->
        <button id="load-slow-cat-btn" class="btn btn-secondary mb-3">
            Load now
        </button>

        <!-- Loading Button (hidden initially) -->
        <button id="loading-slow-cat-btn" class="btn btn-secondary mb-3" type="button" disabled style="display: none;">
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            Loading...
        </button>
    </div>
</div>

<div id="slow-cat"></div>

<script>
$(document).ready(function () {
    $('#load-slow-cat-btn').click(function () {
        // Swap buttons
        $('#load-slow-cat-btn').hide();
        $('#loading-slow-cat-btn').show();

        // Load content
        $('#slow-cat').load('slow-cat.php?wh=<?php echo htmlspecialchars($dashboard_wh, ENT_QUOTES, 'UTF-8'); ?>', function (response, status, xhr) {
            // Hide both buttons permanently
            $('#loading-slow-cat-btn').hide();
            $('#load-slow-cat-btn').hide(); // In case it's somehow still visible

            if (status === "error") {
                $('#slow-cat').html("<p>Error loading content. Please try again later.</p>");
                console.error("Error:", xhr.status, xhr.statusText);
            }
        });
    });
});
</script>
