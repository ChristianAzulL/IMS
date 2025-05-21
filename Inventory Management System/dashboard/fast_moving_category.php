<div class="card h-100" id="fast-cat-container">
    <div class="card-header">
        <h6>Fast Moving Category</h6>
    </div>
    <div class="card-body py-6 text-center">
        <!-- Load Button -->
        <button id="load-now-btn" class="btn btn-primary mb-3">
            Load now
        </button>

        <!-- Loading Button (hidden initially) -->
        <button id="loading-btn" class="btn btn-primary mb-3" type="button" disabled style="display: none;">
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            Loading...
        </button>
    </div>
</div>

<div id="fast-cat"></div>

<script>
$(document).ready(function () {
    $('#load-now-btn').click(function () {
        // Swap buttons
        $('#load-now-btn').hide();
        $('#loading-btn').show();

        // Load content
        $('#fast-cat').load('fast-cat.php?wh=<?php echo htmlspecialchars($dashboard_wh, ENT_QUOTES, 'UTF-8'); ?>', function (response, status, xhr) {
            // Hide both buttons permanently
            $('#loading-btn').hide();
            $('#load-now-btn').hide(); // In case still visible for any reason

            if (status === "error") {
                $('#fast-cat').html("<p>Error loading content. Please try again later.</p>");
                console.error("Error:", xhr.status, xhr.statusText);
            }
        });
    });
});
</script>
