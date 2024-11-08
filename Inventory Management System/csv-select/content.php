<?php 
if (isset($_SESSION['csv_id'])) {
    $csv_id = $_SESSION['csv_id'];
} else {
    header("Location: ../404/");
}
?>

<div class="card">
    <div class="card-body overflow-hidden p-lg-6">
        <div class="row">
            <div class="col-lg-12">
                <form id="myForm" action="csv_process.php" method="POST">
                    <div class="row justify-content-end">
                        <div class="col-auto mb-3">
                            <button class="btn btn-primary" id="submitBTN" type="button">Submit</button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table bordered-table">
                            <thead class="table-info">
                                <tr>
                                    <th></th>
                                    <th style="min-width: 300px;">Product Description</th>
                                    <th style="min-width: 300px;">Matching Product</th>
                                    <th>Keyword</th>
                                    <th>Qty</th>
                                    <th>Price</th>
                                    <th>Supplier</th>
                                    <th style="min-width: 300px;">Matching Supplier</th>
                                    <th>Barcode</th>
                                    <th>Batch no.</th>
                                    <th>Brand</th>
                                    <th>Category</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $csv_query = "SELECT * FROM inbound_csv WHERE csv_id = '$csv_id' AND user_id = '$user_id' ORDER BY id ASC";
                                $csv_Res = $conn->query($csv_query);

                                if ($csv_Res->num_rows > 0) {
                                    while ($row = $csv_Res->fetch_assoc()) {
                                        // Fetch row data
                                        $csv_unique_id = $row['id'];
                                        $csv_product_id = $row['product_id'];
                                        $csv_item = $row['item'];
                                        $csv_keyword = $row['keyword'];
                                        $csv_qty = $row['qty'];
                                        $csv_price = $row['price'];
                                        $csv_supplier = $row['supplier'];
                                        $csv_supplier_id = $row['supplier_id'];
                                        $csv_barcode = $row['barcode'];
                                        $csv_batch = $row['batch'];
                                        $csv_brand = $row['brand'];
                                        $csv_brand_id = $row['brand_id'];
                                        $csv_category = $row['category'];
                                        $csv_category_id = $row['category_id'];
                                        $csv_warehouse = $row['warehouse'];
                                        $csv_user_id = $row['user_id'];
                                ?>
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" id="flexCheckChecked" type="checkbox" name="csv_unique[]" value="<?php echo $csv_unique_id; ?>" checked />
                                        </div>
                                        <!-- Hidden input fields -->
                                        <input type="hidden" name="csv_item[]" value="<?php echo $csv_item; ?>">
                                        <input type="hidden" name="csv_keyword[]" value="<?php echo $csv_keyword; ?>">
                                        <input type="hidden" name="csv_qty[]" value="<?php echo $csv_qty; ?>">
                                        <input type="hidden" name="csv_price[]" value="<?php echo $csv_price; ?>">
                                        <input type="hidden" name="csv_supplier[]" value="<?php echo $csv_supplier; ?>">
                                        <input type="hidden" name="csv_barcode[]" value="<?php echo $csv_barcode; ?>">
                                        <input type="hidden" name="csv_batch[]" value="<?php echo $csv_batch; ?>">
                                        <input type="hidden" name="csv_brand[]" value="<?php echo $csv_brand; ?>">
                                        <input type="hidden" name="csv_category[]" value="<?php echo $csv_category; ?>">
                                        <input type="hidden" name="csv_warehouse[]" value="<?php echo $csv_warehouse; ?>">

                                    </td>
                                    <td><?php echo $csv_item; ?></td>
                                    <td>
                                        <select name="product_id[]" class="form-select <?php echo ($csv_product_id != 0) ? 'bg-success' : ''; ?>">
                                            <option value="reg" style="background-color: green;">Register as new product</option>
                                            <?php 
                                            $product_sql = "SELECT p.*, b.brand_name, c.category_name 
                                                            FROM product p
                                                            LEFT JOIN brand b ON b.id = p.brand
                                                            LEFT JOIN category c ON c.id = p.category
                                                            ORDER BY p.description ASC";
                                            $product_res = $conn->query($product_sql);

                                            if ($product_res->num_rows > 0) {
                                                while ($row = $product_res->fetch_assoc()) {
                                                    $option_product_id = $row['id'];
                                                    $option_product_desc = $row['description'];
                                                    $option_product_brand = $row['brand_name'];
                                                    $option_product_category = $row['category_name'];
                                                    $selected = ($csv_product_id == $option_product_id) ? 'selected' : '';
                                                    echo '<option value="' . $option_product_id . '" ' . $selected . '>' . 
                                                         $option_product_desc . ' | brand: ' . $option_product_brand . ' | category: ' . $option_product_category . '</option>';
                                                }
                                            } else {
                                                echo '<option value="reg">No product found</option>';
                                            }
                                            ?>
                                        </select>
                                    </td>
                                    <td><?php echo $csv_keyword; ?></td>
                                    <td><?php echo $csv_qty; ?></td>
                                    <td><?php echo $csv_price; ?></td>
                                    <td><?php echo $csv_supplier; ?></td>
                                    <td>
                                        <select class="form-select <?php echo ($csv_supplier_id != 0) ? 'bg-success' : ''; ?>" name="supplier_id[]">
                                            <option value="reg_int">Register as new international supplier</option>
                                            <option value="reg_local">Register as new local supplier</option>
                                            <?php
                                            $supplier_sql = "SELECT * FROM supplier ORDER BY supplier_name ASC";
                                            $supplier_res = $conn->query($supplier_sql);

                                            if ($supplier_res->num_rows > 0) {
                                                while ($row = $supplier_res->fetch_assoc()) {
                                                    $option_supplier_id = $row['id'];
                                                    $option_supplier_name = $row['supplier_name'];
                                                    $option_LocalOrInternational = $row['local_international'];
                                                    $selected = ($csv_supplier_id == $option_supplier_id) ? 'selected' : '';
                                                    echo '<option value="' . $option_supplier_id . '" ' . $selected . '>' . 
                                                         $option_supplier_name . ' - ' . $option_LocalOrInternational . '</option>';
                                                }
                                            } else {
                                                echo '<option value="reg">No supplier found</option>';
                                            }
                                            ?>
                                        </select>
                                    </td>
                                    <td><?php echo $csv_barcode; ?></td>
                                    <td><?php echo $csv_batch; ?></td>
                                    <td><?php echo $csv_brand; ?></td>
                                    <td><?php echo $csv_category; ?></td>
                                </tr>
                                <?php 
                                    } // end of while loop
                                } // end of if statement
                                ?>
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById('submitBTN').addEventListener('click', function(event) {
        // Show SweetAlert2 confirmation dialog
        Swal.fire({
            title: "Do you want to save the changes?",
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: "Save",
            denyButtonText: `Don't save`
        }).then((result) => {
            if (result.isConfirmed) {
                // If confirmed, submit the form
                document.getElementById('myForm').submit();
                Swal.fire("Saved!", "", "success");
            } else if (result.isDenied) {
                // If denied, show info alert
                Swal.fire("Changes are not saved", "", "info");
            }
        });
    });
</script>