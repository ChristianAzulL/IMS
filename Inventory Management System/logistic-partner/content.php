<div class="row py-6 px-1">
    <div class="col-lg-12 mb-3">
        <h4>Logistic Partner/s</h4>
    </div>
    
    <div class="col-lg-12">
        <div id="tableExample3" data-list='{"valueNames":["name","email","age"],"page":5,"pagination":true}'>

            <!-- Search form -->
            <div class="row justify-content-end g-0">
                <div class="col-auto col-sm-7 mb-3">
                    <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#error-modal">
                        <span class="fas fa-plus"></span> New
                    </button>
                </div>
                <div class="col-auto col-sm-5 mb-3">
                    <form>
                        <div class="input-group">
                            <input class="form-control form-control-sm shadow-none search" type="search" placeholder="Search..." aria-label="search" />
                            <div class="input-group-text bg-transparent">
                                <span class="fa fa-search fs-10 text-600"></span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Table -->
            <div class="table-responsive scrollbar">
                <table class="table table-bordered table-striped fs-10 mb-0">
                    <thead class="bg-200">
                        <tr>
                            <th class="text-900 sort" data-sort="name">Logistic name</th>
                            <th class="text-900 sort" data-sort="email">Published date</th>
                            <th class="text-900 sort" data-sort="age">Publish by</th>
                            <th class="text-900 sort" ></th>
                        </tr>
                    </thead>
                    <tbody class="list bg-light">
                        <?php
                            $Query = "SELECT lp.*, u.user_fname, u.user_lname 
                                        FROM logistic_partner lp
                                        LEFT JOIN users u ON u.hashed_id = lp.user_id 
                                        ORDER BY lp.id DESC";
                  
                            $res = $conn->query($Query);
                            while($row = $res->fetch_assoc()) {
                                $logistic_name = $row['logistic_name'];
                                $publish_date = date("F j, Y", strtotime($row['date']));
                                $publish_by = $row['user_fname'] . " " . $row['user_lname'];
                                
                                
                                
                            ?>
                            <tr>
                                <td class="name"><b><small class="mb-0"><?php echo $logistic_name;?></small></b>
                                </td>
                                <td class="email"><small><?php echo $publish_date;?></small></td>
                                <td class="age"><small><?php echo $publish_by;?></small></td>
                                <td class="py-1 px-0">
                                    <button class="btn btn-transparent" type="button" data-bs-toggle="modal" data-bs-target="#edit-modal" target-id="<?php echo $row['hashed_id']; ?>"><span class="far fa-edit"></span></button>
                                </td>
                            </tr>
                            <?php
                            }
                        ?>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-3">
                <button class="btn btn-sm btn-falcon-default me-1" type="button" title="Previous" data-list-pagination="prev">
                    <span class="fas fa-chevron-left"></span>
                </button>
                <ul class="pagination mb-0"></ul>
                <button class="btn btn-sm btn-falcon-default ms-1" type="button" title="Next" data-list-pagination="next">
                    <span class="fas fa-chevron-right"></span>
                </button>
            </div>

        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="error-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <form action="../config/add-logistic.php" id="myForm" method="POST">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px">
            <div class="modal-content position-relative">
                <div class="position-absolute top-0 end-0 mt-2 me-2 z-1">
                    <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                    <div class="rounded-top-3 py-3 ps-4 pe-6 bg-body-tertiary">
                        <h4 class="mb-1" id="modalExampleDemoLabel">Add a new logistic</h4>
                    </div>
                    <div class="p-4 pb-0">
                        <div class="mb-3">
                            <label class="col-form-label" for="logistic-name">logistic Name:</label>
                            <input class="form-control" name="logistic-name" id="logistic-name" type="text" />
                            <div class="valid-feedback">Looks good!</div>
                            <div class="invalid-feedback">logistic name already exist</div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary"id="btnsubmit" type="submit" disabled>Submit</button>
                </div>
            </div>
        </div>
    </form>
</div>



<div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px">
    <div class="modal-content position-relative">
      <div class="position-absolute top-0 end-0 mt-2 me-2 z-1">
        <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="update-form" action="../config/update-admin.php?type=logistic" method="POST">
        <div class="modal-body p-0">
            <div class="rounded-top-3 py-3 ps-4 pe-6 bg-body-tertiary">
            <h4 class="mb-1" id="modalExampleDemoLabel">Update </h4>
            </div>
            <div class="p-4 pb-0">
                <div id="form-content" class="mb-3">
                
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
            <button class="btn btn-primary" type="submit">Submit </button>
        </div>
    </form>
    </div>
  </div>
</div>



<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        $("#update-form").on("submit", function(e) {
            e.preventDefault(); // Prevent default form submission
            
            Swal.fire({
                title: "Are you sure?",
                text: "Do you want to update this logistic?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, update it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    // Show loading alert
                    Swal.fire({
                        title: "Processing...",
                        text: "Please wait while updating the logistic.",
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });

                    // Submit the form via AJAX
                    $.ajax({
                        url: $("#update-form").attr("action"),
                        type: $("#update-form").attr("method"),
                        data: $("#update-form").serialize(),
                        success: function(response) {
                            // Assuming the server responds with a success message
                            Swal.fire({
                                title: "Updated!",
                                text: "logistic has been successfully updated.",
                                icon: "success",
                                timer: 2000,
                                showConfirmButton: false
                            });

                            setTimeout(() => {
                                location.reload(); // Reload after success
                            }, 2000);
                        },
                        error: function() {
                            Swal.fire({
                                title: "Error!",
                                text: "Something went wrong. Please try again.",
                                icon: "error"
                            });
                        }
                    });
                }
            });
        });
    });
</script>

<script>
    $(document).ready(function() {
        // When the edit button is clicked
        $(document).on("click", "[data-bs-target='#edit-modal']", function() {
            var targetId = $(this).attr("target-id"); // Get the target-id attribute
            if (targetId) {
                // Load the form-content.php inside #form-content
                $("#form-content").load("form-content.php?id=" + targetId);
            }
        });
    });
</script>








<script>
    $(document).ready(function() {
        // Debounce function to delay the AJAX call until the user stops typing
        let debounceTimer;
        $('#logistic-name').on('input', function() {
            const logisticName = $(this).val();

            // Clear the previous timeout
            clearTimeout(debounceTimer);

            // Set a new timeout for checking the logistic name
            debounceTimer = setTimeout(function() {
                // Perform the AJAX request to check the logistic name
                $.ajax({
                    url: '../config/check-logistic.php',
                    type: 'POST',
                    data: { 'logistic-name': logisticName },
                    dataType: 'json',
                    success: function(response) {
                        // Handle the response from the PHP script
                        if (response.exists) {
                            $('#brand-name').removeClass('is-valid').addClass('is-invalid');
                            $('.invalid-feedback').show();
                            $('.valid-feedback').hide();
                            $('#btnsubmit').prop('disabled', true); // Disable submit button
                        } else {
                            $('#brand-name').removeClass('is-invalid').addClass('is-valid');
                            $('.valid-feedback').show();
                            $('.invalid-feedback').hide();
                            $('#btnsubmit').prop('disabled', false); // Enable submit button
                        }
                    },
                    error: function() {
                        // Handle any errors that occur during the AJAX request
                        alert('Error checking logistic name.');
                    }
                });
            }, 500); // Delay of 500ms after the user stops typing
        });
    });
</script>
