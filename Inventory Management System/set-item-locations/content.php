<?php 
if(isset($_SESSION['selected-warehouse-SIL'])){
    $selected_warehouse_SIL = $_SESSION['selected-warehouse-SIL'];
}
?>
<div class="card">
    <div class="card-body overflow-hidden p-lg-12">
        <div class="add-container text-end mb-3">
            <button class="btn btn-secondary" id="ware-button" type="button" data-bs-toggle="modal" data-bs-target="#ware-modal">Select Warehouse</button>
        </div>
        <form id="barcode-form" method="POST" action="../config/set-item-location.php">
            <div class="row">
                <div class="col-lg-6">
                    <label for="warehouse">Item Location</label>
                    <select class="form-select" name="warehouse" id="warehouse">
                        <option value="">Select Location</option>
                        <?php 
                        if(isset($_SESSION['selected-warehouse-SIL'])){
                            $item_location_query = "SELECT * FROM item_location WHERE warehouse = '$selected_warehouse_SIL'";
                            $result = $conn->query($item_location_query);
                            if($result->num_rows>0){
                                while($row=$result->fetch_assoc()){
                                    echo '<option value="' . $row['id'] . '">' . $row['location_name'] . '</option>';
                                }
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="col-lg-4">
                    <label for="barcode">Barcode</label>
                    <input type="text" class="form-control" name="barcode" id="barcode">
                </div>
                <div class="col-lg-2">
                    <button type="submit" class="btn btn-primary mt-4">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card mt-3">
    <div class="card-body overflow-hidden p-lg-12">
        <div id="list"></div> <!-- List container -->
    </div>
</div>

<div class="card mt-3">
    <div class="card-body overflow-hidden p-lg-12">
        <div class="row text-end">
            <div class="w-3"">
                <button class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>

<!-- Toast for server response -->
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 5">
    <div class="toast fade" id="liveToast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header bg-primary text-white">
            <strong class="me-auto">IMS</strong>
            <small>now</small>
            <div data-bs-theme="dark">
                <button class="btn-close" type="button" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
        <div class="toast-body" id="toast-message">Hello, world! This is a toast message.</div>
    </div>
</div>



<div class="modal fade" id="ware-modal" tabindex="-1" role="dialog" aria-hidden="true ">
  <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px">
    <div class="modal-content position-relative">
      <div class="position-absolute top-0 end-0 mt-2 me-2 z-1">
        <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="../set-item-locations/session.php" method="POST">
      <div class="modal-body p-0">
        <div class="rounded-top-3 py-3 ps-4 pe-6 bg-body-tertiary">
          <h4 class="mb-1" id="modalExampleDemoLabel">Select Warehouse</h4>
        </div>
        <div class="p-4 pb-0">
            <div class="mb-3">
              <label class="col-form-label" for="recipient-name">Warehouse</label>
              <select class="form-select" name="wh" id="wh" required>
                <option value="">Select Warehouse</option>
                <?php 
                foreach ($user_warehouse_ids as $id) {
                    $id = trim($id);
                    $warehouse_info_query = "SELECT * FROM warehouse WHERE hashed_id = '$id'";
                    $warehouse_info_result = mysqli_query($conn, $warehouse_info_query);
                    if ($warehouse_info_result->num_rows > 0) {
                        $row = $warehouse_info_result->fetch_assoc();
                        $tab_warehouse_name = $row['warehouse_name'];
                        echo '<option value="' . $id . '">' . $tab_warehouse_name . '</option>';
                    }
                }
                ?>
              </select>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
        <button class="btn btn-primary" type="submit">Understood </button>
      </div>
      </form>
    </div>
  </div>
</div>

<?php
// Check if the session variable 'selected-warehouse-SIL' is set
if (!isset($_SESSION['selected-warehouse-SIL'])) {
    // Output JavaScript to trigger the button click
    echo '<script>
            window.onload = function() {
                document.getElementById("ware-button").click();
            };
          </script>';
}
?>


<!-- JavaScript -->
<script>
    $(document).ready(function () {
        // Focus on the barcode input when the page loads
        $('#barcode').focus();

        // Load the list content when the page loads
        loadList();

        // Handle form submission via AJAX
        $('#barcode-form').on('submit', function (e) {
            e.preventDefault(); // Prevent the form from reloading the page

            var formData = $(this).serialize(); // Get the form data

            $.ajax({
                url: $(this).attr('action'), // Get the form action (server-side PHP script)
                method: 'POST',
                data: formData, // Send the form data to the server
                success: function(response) {
                    // Clear the barcode input field and focus on it again
                    $('#barcode').val('');
                    $('#barcode').focus();

                    // Parse the JSON response from the server
                    var responseData = JSON.parse(response);

                    // Show the server's response in the toast message
                    $('#toast-message').text(responseData.message);

                    // Show the toast
                    var toast = new bootstrap.Toast($('#liveToast')[0]);
                    toast.show();

                    // Reload the list after form submission
                    loadList();
                },
                error: function() {
                    // Handle error if AJAX request fails
                    $('#toast-message').text('An error occurred. Please try again.');

                    var toast = new bootstrap.Toast($('#liveToast')[0]);
                    toast.show();
                }
            });
        });

        // Function to load the list content
        function loadList() {
            $.ajax({
                url: 'list.php', // URL of the list.php file
                method: 'GET',
                success: function(response) {
                    $('#list').html(response); // Inject the response into the list div
                },
                error: function() {
                    $('#list').html('<p>Failed to load list. Please try again.</p>');
                }
            });
        }
    });
</script>
