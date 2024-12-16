<div class="row">
    <div class="col-lg-12">
        <div class="card" style="height: 85vh;">
            <!-- Card Header -->
            <div class="card-header">
                <div class="my-3" id="barcode-form"></div>
            </div>
            <form action="sample.php" method="post">
            <!-- Card Body -->
            <div class="card-body overflow-hidden scrollbar border-top border-bottom">
                <div class="table-responsive" style="height: 50vh; overflow-y: auto;">
                    <table class="table table-sm">
                        <thead class="table-dark">
                            <tr>
                                <th style="width: 30px;"></th>
                                <th>Barcode</th>
                                <th>Description</th>
                                <th class="text-end">Capital(₱)</th>
                                <th>Selling Price(₱)</th>
                                <th>Keyword</th>
                                <th>Batch Number</th>
                                <th>Brand Name</th>
                                <th>Category Name</th>
                            </tr>
                        </thead>
                        <tbody id="table-body"></tbody>

                    </table>
                </div>    
            </div>

            <!-- Card Footer -->
            <div class="card-footer">
                <div class="row">

                    <!-- Left Column -->
                    <div class="col-8">
                        <div class="row">

                            <!-- Customer Name -->
                            <div class="col-8 mb-3">
                                <label for="">Customer Name</label>
                                <input class="form-control" type="text" required>
                            </div>

                            <!-- Platform -->
                            <div class="col-4 mb-3">
                                <label for="">Platform</label>
                                <select class="form-select" name="platform" id="" required>
                                    <?php 
                                    $sql = "SELECT * FROM logistic_partner ORDER BY logistic_name";
                                    $res = $conn->query($sql);

                                    if ($res->num_rows > 0) {
                                        while ($row = $res->fetch_assoc()) {
                                            echo "<option value='" . $row['hashed_id'] . "'>" . $row['logistic_name'] . "</option>";
                                        }
                                    } else {
                                        echo "<option value=''>No Data</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <!-- Courier -->
                            <div class="col-3 mb-3">
                                <label for="">Courier</label>
                                <select class="form-select" name="courier" id="" required>
                                    <?php 
                                    $sql = "SELECT * FROM courier ORDER BY courier_name ASC";
                                    $res = $conn->query($sql);

                                    if ($res->num_rows > 0) {
                                        while ($row = $res->fetch_assoc()) {
                                            echo "<option value='" . $row['hashed_id'] . "'>" . $row['courier_name'] . "</option>";
                                        }
                                    } else {
                                        echo "<option value=''>No Data</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <!-- Order Number -->
                            <div class="col-3 mb-3">
                                <label for="">Order no.</label>
                                <input class="form-control" type="text" required>
                            </div>

                            <!-- Order Line ID -->
                            <div class="col-3 mb-3">
                                <label for="">Order Line ID</label>
                                <input class="form-control" type="text" required>
                            </div>

                            <!-- Process By -->
                            <div class="col-3 mb-3">
                                <label for="">Process by</label>
                                <input class="form-control" type="text" readonly value="<?php echo $user_fullname; ?>">
                            </div>
                        </div>
                    </div>
                    
                    <!-- Right Column -->
                    <div class="col-4 border-start">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6 text-start">
                                    <p><b>Total:</b></p>
                                </div>
                                <div class="col-6 text-end">
                                    <p id="total" class="fw-bold">Total: 0.00</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <button class="btn btn-primary w-100">Submit</button>
                        </div>
                    </div>
                    
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Add this in the <head> or before </body> -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function () {
        let sellingInputClicked = false; // Track if the alert has been shown

        // Load barcode form initially
        loadBarcodeForm();

        // Load table content
        loadContent();

        // Function to load the barcode form
        function loadBarcodeForm() {
            $('#barcode-form').load('barcode-form.php', function () {
                $('#barcode').focus();
            });
        }

        // Function to load table content
        function loadContent() {
            $.ajax({
                url: 'bor.php?view=sample', // URL of the PHP file
                method: 'GET',
                success: function (data) {
                    $('#table-body').html(data);

                    // Rebind events after loading content
                    bindSellingInputEvent();
                    calculateTotal();
                },
                error: function (xhr, status, error) {
                    console.error('Error loading content:', error);
                }
            });
        }

        // Event delegation for calculateTotal
        $(document).on('input', '.selling-input', function () {
            calculateTotal();
        });

        // Calculate total
        function calculateTotal() {
            let total = 0;
            $('.selling-input').each(function () {
                const value = parseFloat($(this).val());
                if (!isNaN(value)) {
                    total += value;
                }
            });
            $('#total').text(`Total: ${total.toFixed(2)}`);
        }

        // Show warning on first click of selling input
        function bindSellingInputEvent() {
            $('.selling-input').one('focus', function () {
                if (!sellingInputClicked) {
                    sellingInputClicked = true; // Set to true after first alert
                    Swal.fire({
                        icon: 'warning',
                        title: 'Finalize Items First!',
                        text: 'If you input any values here, they will be cleared if you delete any barcode.',
                        confirmButtonText: 'OK'
                    });
                }
            });
        }

        // Event delegation for action buttons
        $(document).on('click', '.action-button', function () {
            const barcode = $(this).data('barcode');

            // Send AJAX request
            $.ajax({
                url: 'action.php',
                method: 'POST',
                data: { barcode: barcode },
                dataType: 'json',
                success: function (response) {
                    if (response.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: response.message,
                            confirmButtonText: 'OK'
                        });

                        // Reload table content
                        loadContent();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.message,
                            confirmButtonText: 'OK'
                        });
                    }
                },
                error: function () {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'An unexpected error occurred. Please try again later.',
                        confirmButtonText: 'OK'
                    });
                }
            });
        });

        
        // Include SweetAlert2 (make sure it's loaded in your HTML)
        $(document).on('submit', '#myForm', function (e) {
            e.preventDefault();

            $.ajax({
                type: $(this).attr('method'),
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: 'json',
                success: function (response) {
                    if (response.error) {
                        // Display SweetAlert2 error message
                        Swal.fire({
                            icon: 'warning',
                            title: response.error,
                            confirmButtonText: 'OK'
                        }).then(() => {
                            loadBarcodeForm();
                        });
                    } else {
                        // Reload data
                        loadBarcodeForm();
                        loadContent();
                    }
                },
                error: function () {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'An unexpected error occurred. Please try again later.',
                        confirmButtonText: 'OK'
                    });
                }
            });
        });


    });
</script>
