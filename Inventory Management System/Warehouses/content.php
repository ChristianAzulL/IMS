<div class="row py-6 px-1">
    <div class="col-lg-12 mb-3">
        <h4>Warehouse/Branches</h4>
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
                            <th class="text-900 sort" data-sort="name">Warehouse name</th>
                            <th class="text-900 sort" data-sort="status">Status</th>
                            <th class="text-900 sort" data-sort="email">Published date</th>
                            <th class="text-900 sort" data-sort="age">Publish by</th>
                            <th class="text-900 sort" ></th>
                        </tr>
                    </thead>
                    <tbody class="list bg-light">
                        <?php
                            $Query = "SELECT w.*, u.user_fname, u.user_lname 
                                        FROM warehouse w
                                        LEFT JOIN users u ON u.id = w.user_id 
                                        ORDER BY w.id DESC";
                  
                            $res = $conn->query($Query);
                            while($row = $res->fetch_assoc()) {
                                $warehouse_name = $row['warehouse_name'];
                                $publish_date = date("F j, Y", strtotime($row['date']));
                                $publish_by = $row['user_fname'] . " " . $row['user_lname'];
                                if($row['warehouse_status'] == 0){
                                    $status = '<span class="badge bg-danger">Disabled</span>';
                                } else {
                                    $status = '<span class="badge bg-success">Enabled</span>';
                                }
                            ?>
                            <tr>
                                <td class="name"><b><small><?php echo $warehouse_name;?></small></b></td>
                                <td class="status"><?php echo $status;?></td>
                                <td class="email"><small><?php echo $publish_date;?></small></td>
                                <td class="age"><small><?php echo $publish_by;?></small></td>
                                <td class="py-1 px-0"><button class="btn btn-danger py-0" type="button" data-bs-toggle="tooltip" data-bs-placement="left" title="disable"><small><span class="fas fa-minus"></span></small></button></td>
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
    <form action="../config/add-warehouse.php" id="myForm" method="POST">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px">
            <div class="modal-content position-relative">
                <div class="position-absolute top-0 end-0 mt-2 me-2 z-1">
                    <button class="btn-close btn btn-sm btn-circle d-flex flex-center transition-base" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                    <div class="rounded-top-3 py-3 ps-4 pe-6 bg-body-tertiary">
                        <h4 class="mb-1" id="modalExampleDemoLabel">Add a new warehouse</h4>
                    </div>
                    <div class="p-4 pb-0">
                        <div class="mb-3">
                            <label class="col-form-label" for="warehouse-name">Warehouse Name:</label>
                            <input class="form-control" name="warehouse-name" id="warehouse-name" type="text" />
                            <div class="valid-feedback">Looks good!</div>
                            <div class="invalid-feedback">Warehouse name already exist</div>
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


<script>
    $(document).ready(function () {
        // Function to check all rows
        function checkAllRows() {
            const items = [];
            const brands = [];
            const categories = [];
            const rows = $('table tr'); // Adjust selector to your table

            // Collect all item, brand, and category values from the rows
            rows.each(function (index) {
                const item = $(this).find('input[name="item[]"]').val();
                const brand = $(this).find('input[name="brand[]"]').val();
                const category = $(this).find('input[name="category[]"]').val();
                
                items.push(item);
                brands.push(brand);
                categories.push(category);
            });

            // Send batch data (item, brand, category) to the server
            $.ajax({
                url: '../config/check-product-csv-existence.php',  // Ensure this points to the correct path
                type: 'POST',
                data: JSON.stringify({ items, brands, categories }),  // Sending item, brand, and category values
                contentType: 'application/json',
                dataType: 'json',
                success: function (response) {
                    rows.each(function (index) {
                        const row = $(this);
                        const itemInput = row.find('input[name="item[]"]');
                        const result = response[index];

                        // Item Feedback: show feedback based on product existence
                        if (result.itemExists) {
                            itemInput.removeClass('is-valid').addClass('is-invalid');
                            itemInput.next('.invalid-feedback').text('Product already exists').show();
                        } else {
                            itemInput.removeClass('is-invalid').addClass('is-valid');
                            itemInput.next('.valid-feedback').text('Will be registered as new.').show();
                        }
                    });
                },
                error: function () {
                    alert('Error checking products.');
                }
            });
        }

        // Check all rows once on page load
        checkAllRows();

        // Debounce input check (after the user stops typing)
        let debounceTimer;
        $('input[name="item[]"], input[name="brand[]"], input[name="category[]"]').on('input', function () {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(checkAllRows, 500);
        });
    });
</script>

