<div class="row">
    <div class="col-xxl-6 mb-3">
        <div class="row">
            <div class="col-lg-12">
                <form id="ajax-form" action="action.php" method="POST">
                    <div class="p-3">
                            <div class="row">
                                <div class="col-md-12">
                                    <div id="form-content"></div> <!-- Form content will be loaded here -->
                                </div>
                                <div class="col-md-12">
                                    <button class="w-100 btn btn-primary" type="submit">Submit</button>
                                </div>
                            </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-xxl-6 mb-3">
      <div class="card">
        <div class="card-body">
          <div id="session_load"></div>
        </div>
      </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Load form-content.php into #form-content
    $("#form-content").load("form-content.php");

    // Load session_load.php into #session_load
    function loadSessionData() {
        $("#session_load").load("session_load.php");
    }

    loadSessionData(); // Initial load

    // Handle form submission via AJAX
    $("#ajax-form").submit(function(e) {
        e.preventDefault(); // Prevent full page reload

        var formData = $(this).serialize(); // Serialize form data

        $.ajax({
            url: $(this).attr("action"),
            type: "POST",
            data: formData,
            dataType: "json",
            success: function(response) {
                Swal.fire({
                    icon: response.status === 'success' ? 'success' : 'error',
                    title: response.status === 'success' ? 'Success!' : 'Error!',
                    text: response.message
                });

                if (response.status === 'success') {
                    $("#form-content").load("form-content.php"); // Reload form content
                    loadSessionData(); // Reload session table
                }
            },
            error: function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Something went wrong. Please try again.'
                });
            }
        });
    });

    // Handle delete button click (event delegation)
    $(document).on("click", ".delete-session-item", function() {
        var barcode = $(this).data("barcode");

        $.ajax({
            url: "delete_session.php",
            type: "POST",
            data: { barcode: barcode },
            success: function(response) {
                loadSessionData(); // Reload session table after deletion
            },
            error: function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Failed to delete item.'
                });
            }
        });
    });
});

</script>