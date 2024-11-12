
<?php 
// Generate a new CSRF token if it doesn't exist
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32)); // Generate a secure random token
}
?>
<div class="row py-6 px-1">
    <div class="col-lg-12 mb-3">
        <h4>Access Level</h4>
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
                            <th class="text-900 sort" data-sort="name">Position name</th>
                            <th class="text-900 sort" data-sort="status">Status</th>
                            <th class="text-900 sort" data-sort="email">Published date</th>
                            <th class="text-900 sort" data-sort="age">Publish by</th>
                            <th class="text-900 sort" ></th>
                        </tr>
                    </thead>
                    <tbody class="list bg-light">
                        <?php
                            $Query = "SELECT a.*, u.user_fname, u.user_lname 
                                        FROM user_position a
                                        LEFT JOIN users u ON u.id = a.user_id 
                                        ORDER BY a.id DESC";
                  
                            $res = $conn->query($Query);
                            while($row = $res->fetch_assoc()) {
                                $position_name = $row['position_name'];
                                $publish_date = date("F j, Y", strtotime($row['date']));
                                $publish_by = $row['user_fname'] . " " . $row['user_lname'];
                                 if($row['position_status'] == 0){
                                    $status = '<span class="badge bg-danger">Disabled</span>';
                                } else {
                                    $status = '<span class="badge bg-success">Enabled</span>';
                                }
                            ?>
                            <tr>
                                <td class="name"><b><small><?php echo $position_name;?></small></b></td>
                                <td class="status"><?php echo $status;?></td>
                                <td class="email"><small><?php echo $publish_date;?></small></td>
                                <td class="age"><small><?php echo $publish_by;?></small></td>
                                <td class="py-1 px-0">
                                    <button class="btn btn-transparent py-0" type="button"  data-bs-toggle="modal" data-bs-target="#edit-modal_<?php echo $row['id'];?>"><small><span class="far fa-edit" data-bs-toggle="tooltip" data-bs-placement="left" title="Edit" ></span></small></button>
                                    <button class="btn btn-transparent py-0" title="Enable Position"><span class="far fa-check-circle"></span></button>
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
    <form action="../config/add-position.php" method="POST">
    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>" />
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content position-relative">
                <div class="position-absolute top-0 end-0 mt-2 me-2 z-1">
                    <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                    <div class="rounded-top-3 py-3 ps-4 pe-6 bg-body-tertiary">
                        <h4 class="mb-1" id="modalExampleDemoLabel">Add a new position</h4>
                    </div>
                    <div class="p-4 pb-0">
                        <div class="mb-3">
                            <label class="col-form-label" for="position-name">position Name:</label>
                            <input class="form-control" name="position-name" id="position-name" type="text" />
                            <div class="valid-feedback">Looks good!</div>
                            <div class="invalid-feedback">position name already exist</div>
                        </div>

                    </div>
                    <div class="row p-4 pb-0 mb-3">
                        <div class="col-lg-12 mb-3">
                            <label for="">Inbounds</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input"  name="access[]" id="flexSwitchCheckDefault" type="checkbox" value="po_logs" />
                                <label class="form-check-label" for="flexSwitchCheckDefault">View Purchased Order logs</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input"  name="access[]" id="flexSwitchCheckDefault" type="checkbox" value="new_po" />
                                <label class="form-check-label" for="flexSwitchCheckDefault">Create Purchased Order</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input"  name="access[]" id="flexSwitchCheckDefault" type="checkbox" value="inbound_logs" />
                                <label class="form-check-label" for="flexSwitchCheckDefault">View Inbound logs</label>
                            </div>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="">Product Management</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input"  name="access[]" id="flexSwitchCheckDefault" type="checkbox" value="product_list" />
                                <label class="form-check-label" for="flexSwitchCheckDefault">View Product list</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input"  name="access[]" id="flexSwitchCheckDefault" type="checkbox" value="product_destination" />
                                <label class="form-check-label" for="flexSwitchCheckDefault">Create and create item destination</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input"  name="access[]" id="flexSwitchCheckDefault" type="checkbox" value="stock" />
                                <label class="form-check-label" for="flexSwitchCheckDefault">View stock</label>
                            </div>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="">Logistics</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input"  name="access[]" id="flexSwitchCheckDefault" type="checkbox" value="logistics" />
                                <label class="form-check-label" for="flexSwitchCheckDefault">Logistics Access</label>
                            </div>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="">Stock Transfer</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input"  name="access[]" id="flexSwitchCheckDefault" type="checkbox" value="stock_transfer" />
                                <label class="form-check-label" for="flexSwitchCheckDefault">View and Create Stock Transfer</label>
                            </div>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="">Returns</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input"  name="access[]" id="flexSwitchCheckDefault" type="checkbox" value="returns" />
                                <label class="form-check-label" for="flexSwitchCheckDefault">View and Create Return to Supplier</label>
                            </div>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="">Finance</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input"  name="access[]" id="flexSwitchCheckDefault" type="checkbox" value="finance" />
                                <label class="form-check-label" for="flexSwitchCheckDefault">Access on finance module</label>
                            </div>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="">Forecasting</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input"  name="access[]" id="flexSwitchCheckDefault" type="checkbox" value="forecasting" />
                                <label class="form-check-label" for="flexSwitchCheckDefault">View and create forecast</label>
                            </div>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="">Users</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input"  name="access[]" id="flexSwitchCheckDefault" type="checkbox" value="users" />
                                <label class="form-check-label" for="flexSwitchCheckDefault">View  and create user employee accounts</label>
                            </div>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="">administration</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input"  name="access[]" id="flexSwitchCheckDefault" type="checkbox" value="administration" />
                                <label class="form-check-label" for="flexSwitchCheckDefault">Administrator Access</label>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary" id="btnsubmit" type="submit" disabled>Submit</button>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- Modal -->
<div class="modal fade" id="error-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <form action="../config/add-position.php" id="myForm" method="POST">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content position-relative">
                <div class="position-absolute top-0 end-0 mt-2 me-2 z-1">
                    <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                    <div class="rounded-top-3 py-3 ps-4 pe-6 bg-body-tertiary">
                        <h4 class="mb-1" id="modalExampleDemoLabel">Add a new position</h4>
                    </div>
                    <div class="p-4 pb-0">
                        <div class="mb-3">
                            <label class="col-form-label" for="position-name">position Name:</label>
                            <input class="form-control" name="position-name" id="position-name" type="text" />
                        </div>

                    </div>
                    <div class="row p-4 pb-0 mb-3">
                        <div class="col-lg-12 mb-3">
                            <label for="">Inbounds</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input"  name="access[]" id="flexSwitchCheckDefault" type="checkbox" value="po_logs" />
                                <label class="form-check-label" for="flexSwitchCheckDefault">View Purchased Order logs</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input"  name="access[]" id="flexSwitchCheckDefault" type="checkbox" value="new_po" />
                                <label class="form-check-label" for="flexSwitchCheckDefault">Create Purchased Order</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input"  name="access[]" id="flexSwitchCheckDefault" type="checkbox" value="inbound_logs" />
                                <label class="form-check-label" for="flexSwitchCheckDefault">View Inbound logs</label>
                            </div>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="">Product Management</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input"  name="access[]" id="flexSwitchCheckDefault" type="checkbox" value="product_list" />
                                <label class="form-check-label" for="flexSwitchCheckDefault">View Product list</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input"  name="access[]" id="flexSwitchCheckDefault" type="checkbox" value="product_destination" />
                                <label class="form-check-label" for="flexSwitchCheckDefault">Create and create item destination</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input"  name="access[]" id="flexSwitchCheckDefault" type="checkbox" value="stock" />
                                <label class="form-check-label" for="flexSwitchCheckDefault">View stock</label>
                            </div>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="">Logistics</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input"  name="access[]" id="flexSwitchCheckDefault" type="checkbox" value="logistics" />
                                <label class="form-check-label" for="flexSwitchCheckDefault">Logistics Access</label>
                            </div>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="">Stock Transfer</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input"  name="access[]" id="flexSwitchCheckDefault" type="checkbox" value="stock_transfer" />
                                <label class="form-check-label" for="flexSwitchCheckDefault">View and Create Stock Transfer</label>
                            </div>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="">Returns</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input"  name="access[]" id="flexSwitchCheckDefault" type="checkbox" value="returns" />
                                <label class="form-check-label" for="flexSwitchCheckDefault">View and Create Return to Supplier</label>
                            </div>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="">Finance</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input"  name="access[]" id="flexSwitchCheckDefault" type="checkbox" value="finance" />
                                <label class="form-check-label" for="flexSwitchCheckDefault">Access on finance module</label>
                            </div>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="">Forecasting</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input"  name="access[]" id="flexSwitchCheckDefault" type="checkbox" value="forecasting" />
                                <label class="form-check-label" for="flexSwitchCheckDefault">View and create forecast</label>
                            </div>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="">Users</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input"  name="access[]" id="flexSwitchCheckDefault" type="checkbox" value="users" />
                                <label class="form-check-label" for="flexSwitchCheckDefault">View  and create user employee accounts</label>
                            </div>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="">administration</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input"  name="access[]" id="flexSwitchCheckDefault" type="checkbox" value="administration" />
                                <label class="form-check-label" for="flexSwitchCheckDefault">Administrator Access</label>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary" id="btnsubmit" type="submit">Submit</button>
                </div>
            </div>
        </div>
    </form>
</div>

<?php
$repeat = "SELECT * FROM user_position";
$result = mysqli_query($conn, $repeat);
if($result->num_rows>0){
    while($row=$result->fetch_assoc()){
        $account_position_id = $row['id'];
        $account_position_name = $row['position_name'];
        $account_position_access = $row['access'];
?>
<!-- Modal -->
<div class="modal fade" id="edit-modal_<?php echo $account_position_id;?>" tabindex="-1" role="dialog" aria-hidden="true">
    <form action="../config/add-position.php" method="POST">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content position-relative">
                <div class="position-absolute top-0 end-0 mt-2 me-2 z-1">
                    <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                    <div class="rounded-top-3 py-3 ps-4 pe-6 bg-body-tertiary">
                        <h4 class="mb-1" id="modalExampleDemoLabel">Add a new position</h4>
                    </div>
                    <div class="p-4 pb-0">
                        <div class="mb-3">
                            <label class="col-form-label" for="position-name">position Name:</label>
                            <input class="form-control" name="position-name" id="position-name" type="text" value="<?php echo $account_position_name;?>"/>
                        </div>

                    </div>
                    <div class="row p-4 pb-0 mb-3">
                        <div class="col-lg-12 mb-3">
                            <label for="">Inbounds</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input" <?php if(strpos($account_position_access, "po_logs")!==false){echo 'checked=""';}?>  name="access[]" id="flexSwitchCheckDefault" type="checkbox" value="po_logs" />
                                <label class="form-check-label" for="flexSwitchCheckDefault">View Purchased Order logs</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" <?php if(strpos($account_position_access, "new_po")!==false){echo 'checked=""';}?> name="access[]" id="flexSwitchCheckDefault" type="checkbox" value="new_po" />
                                <label class="form-check-label" for="flexSwitchCheckDefault">Create Purchased Order</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" <?php if(strpos($account_position_access, "inbound_logs")!==false){echo 'checked=""';}?> name="access[]" id="flexSwitchCheckDefault" type="checkbox" value="inbound_logs" />
                                <label class="form-check-label" for="flexSwitchCheckDefault">View Inbound logs</label>
                            </div>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="">Product Management</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input" <?php if(strpos($account_position_access, "product_list")!==false){echo 'checked=""';}?> name="access[]" id="flexSwitchCheckDefault" type="checkbox" value="product_list" />
                                <label class="form-check-label" for="flexSwitchCheckDefault">View Product list</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" <?php if(strpos($account_position_access, "product_destination")!==false){echo 'checked=""';}?> name="access[]" id="flexSwitchCheckDefault" type="checkbox" value="product_destination" />
                                <label class="form-check-label" for="flexSwitchCheckDefault">Create and create item destination</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" <?php if(strpos($account_position_access, "stock")!==false){echo 'checked=""';}?> name="access[]" id="flexSwitchCheckDefault" type="checkbox" value="stock" />
                                <label class="form-check-label" for="flexSwitchCheckDefault">View stock</label>
                            </div>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="">Logistics</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input" <?php if(strpos($account_position_access, "logistics")!==false){echo 'checked=""';}?> name="access[]" id="flexSwitchCheckDefault" type="checkbox" value="logistics" />
                                <label class="form-check-label" for="flexSwitchCheckDefault">Logistics Access</label>
                            </div>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="">Stock Transfer</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input" <?php if(strpos($account_position_access, "stock_transfer")!==false){echo 'checked=""';}?> name="access[]" id="flexSwitchCheckDefault" type="checkbox" value="stock_transfer" />
                                <label class="form-check-label" for="flexSwitchCheckDefault">View and Create Stock Transfer</label>
                            </div>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="">Returns</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input" <?php if(strpos($account_position_access, "returns")!==false){echo 'checked=""';}?> name="access[]" id="flexSwitchCheckDefault" type="checkbox" value="returns" />
                                <label class="form-check-label" for="flexSwitchCheckDefault">View and Create Return to Supplier</label>
                            </div>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="">Finance</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input" <?php if(strpos($account_position_access, "finance")!==false){echo 'checked=""';}?> name="access[]" id="flexSwitchCheckDefault" type="checkbox" value="finance" />
                                <label class="form-check-label" for="flexSwitchCheckDefault">Access on finance module</label>
                            </div>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="">Forecasting</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input" <?php if(strpos($account_position_access, "forecasting")!==false){echo 'checked=""';}?> name="access[]" id="flexSwitchCheckDefault" type="checkbox" value="forecasting" />
                                <label class="form-check-label" for="flexSwitchCheckDefault">View and create forecast</label>
                            </div>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="">Users</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input" <?php if(strpos($account_position_access, "users")!==false){echo 'checked=""';}?> name="access[]" id="flexSwitchCheckDefault" type="checkbox" value="users" />
                                <label class="form-check-label" for="flexSwitchCheckDefault">View  and create user employee accounts</label>
                            </div>
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="">administration</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input" <?php if(strpos($account_position_access, "administration")!==false){echo 'checked=""';}?> name="access[]" id="flexSwitchCheckDefault" type="checkbox" value="administration" />
                                <label class="form-check-label" for="flexSwitchCheckDefault">Administrator Access</label>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
            </div>
        </div>
    </form>
</div>
<?php

    }
}
?>



<script>
    $(document).ready(function() {
        // Debounce function to delay the AJAX call until the user stops typing
        let debounceTimer;
        $('#position-name').on('input', function() {
            const positionName = $(this).val();

            // Clear the previous timeout
            clearTimeout(debounceTimer);

            // Set a new timeout for checking the position name
            debounceTimer = setTimeout(function() {
                // Perform the AJAX request to check the position name
                $.ajax({
                    url: '../config/check-position.php',
                    type: 'POST',
                    data: { 'position-name': positionName },
                    dataType: 'json',
                    success: function(response) {
                        // Handle the response from the PHP script
                        if (response.exists) {
                            $('#position-name').removeClass('is-valid').addClass('is-invalid');
                            $('.invalid-feedback').show();
                            $('.valid-feedback').hide();
                            $('#btnsubmit').prop('disabled', true); // Disable submit button
                        } else {
                            $('#position-name').removeClass('is-invalid').addClass('is-valid');
                            $('.valid-feedback').show();
                            $('.invalid-feedback').hide();
                            $('#btnsubmit').prop('disabled', false); // Enable submit button
                        }
                    },
                    error: function() {
                        // Handle any errors that occur during the AJAX request
                        alert('Error checking position name.');
                    }
                });
            }, 500); // Delay of 500ms after the user stops typing
        });
    });
</script>