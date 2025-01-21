<?php 
$selected_warehouse_id = $_SESSION['selected_warehouse_id'];
$selected_warehouse_name = $_SESSION['selected_warehouse_name'];
?>

<div class="card">
    <div class="card-body overflow-hidden py-6 px-2">
        <form action="../config/create_po.php" method="POST">
        <h5>SELECT SUPPLIER AND QUANTITY</h5>
        <div class="card shadow-none">
            <div class="card-body p-0 pb-3" data-list='{"valueNames":["desc","barcode","brand","cat","qty","trans"]}'>
                <div class="d-flex align-items-center justify-content-end my-3">
                    <div class="col-auto text-end mb-3 me-1">
                        <select class="form-select" name="supplier" required>
                            <option value="">Select Supplier</option>
                            <?php 
                            $supplier_query = "SELECT * FROM supplier ORDER BY supplier_name ASC";
                            $supplier_res = $conn->query($supplier_query);
                            if($supplier_res->num_rows > 0) {
                                while($supplier_row = $supplier_res->fetch_assoc()) {
                                    $supplier = $supplier_row['supplier_name'];
                                    $supplier_id = $supplier_row['hashed_id'];
                                    echo '<option value="' . $supplier_id . '">' . $supplier . '</option>';
                                }
                            } else {
                                echo '<option value="">No Supplier Available</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-auto text-end mb-3 me-1">
                        <div id="bulk-select-replace-element">
                            <button class="btn btn-falcon-success btn-sm" type="submit">
                                <span class="fas fa-plus" data-fa-transform="shrink-3 down-2"></span>
                                <span class="ms-1">Submit</span>
                            </button>
                        </div>
                    </div>
                    
                    <div class="d-none ms-3" id="bulk-select-actions"></div>
                </div>

                <div class="table-responsive scrollbar">
                    <table class="table mb-0">
                        <thead class="bg-200">
                            <tr>
                                <th width="50"></th>
                                <th class="text-black dark__text-white align-middle sort" data-sort="desc">Description</th>
                                <th class="text-black dark__text-white align-middle sort" data-sort="desc">Parent Barcode</th>
                                <th class="text-black dark__text-white align-middle sort" data-sort="barcode">Brand</th>
                                <th class="text-black dark__text-white align-middle sort" data-sort="cat">Category</th>
                                <th class="text-black dark__text-white align-middle sort" style="min-width: 250px;" hidden>Supplier</th>
                                <th class="text-black dark__text-white align-middle sort" style="min-width: 150px;">Order Quantity</th>
                                <th class="text-black dark__text-white align-middle white-space-nowrap pe-3 sort" data-sort="qty">Quantity</th>
                                <th class="text-black dark__text-white align-middle text-end pe-3 sort" data-sort="trans_dd">Transactions(dd)</th>
                                <th class="text-black dark__text-white align-middle text-end pe-3 sort" data-sort="trans_mm">Transactions(mm)</th>
                                <th class="text-black dark__text-white align-middle text-end pe-3 sort" data-sort="trans_yy">Transactions(yy)</th>
                            </tr>
                        </thead>
                        <tbody id="bulk-select-body" class="list">
                            <?php 
                            // Check if the form is submitted
                            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                // Check if any checkboxes are selected
                                if (isset($_POST['product_id']) && is_array($_POST['product_id'])) {
                                    // Loop through each selected checkbox
                                    foreach ($_POST['product_id'] as $selectedProductId) {
                                        // Retrieve data associated with the selected product id
                                        $product_key = array_search($selectedProductId, $_POST['product_id']);
                                        $product_id = $_POST['product_id'][$product_key];
                                        $product_img = $_POST['product_image'][$product_key];
                                        $product_des = $_POST['product_desc'][$product_key];
                                        $product_pbarcode = $_POST['parent_barcode'][$product_key];
                                        $product_brand = $_POST['brand'][$product_key];
                                        $product_category = $_POST['category'][$product_key];
                                        $current_stock = $_POST['qty'][$product_key];
                                        $current_total_transaction_daily = $_POST['trans_day'][$product_key];
                                        $current_total_transaction_monthly = $_POST['trans_month'][$product_key];
                                        $current_total_transaction_yearly = $_POST['trans_year'][$product_key];
                                        

                                        ?>
                                        
                                        <tr>
                                            <td>
                                                <img class="img img-fluid m-0" src="../../assets/img/<?php echo basename($product_img); ?>" alt="">
                                            </td>
                                            <th class="align-middle desc"><?php echo $product_des; ?></th>
                                            <th class="align-middle barcode"><?php echo $product_pbarcode; ?></th>
                                            <td class="align-middle brand"><?php echo $product_brand; ?></td>
                                            <td class="align-middle cat"><?php echo $product_category; ?></td>
                                            <td class="align-middle cat" >
                                                <input type="text" name="product_id[]" value="<?php echo $product_id;?>" readonly hidden>
                                                <input type="text" name="parent_barcode[]" value="<?php echo $product_pbarcode;?>" readonly hidden>
                                                <input type="text" name="product_desc[]" value="<?php echo $product_des;?>" readonly hidden>
                                                <input type="text" name="brand[]" value="<?php echo $product_brand;?>" readonly hidden>
                                                <input type="text" name="category[]" value="<?php echo $product_category;?>" readonly hidden>
                                                
                                            </td>
                                            <td class="align-middle cat">
                                                <input type="number" name="order_qty[]" class="form-control" min="0" placeholder="Order Qty">
                                            </td>
                                            <td class="align-middle white-space-nowrap text-end pe-3 qty"><?php echo $current_stock; ?></td>
                                            <td class="align-middle text-end pe-3 trans_dd"><?php echo $current_total_transaction_daily; ?></td>
                                            <td class="align-middle text-end pe-3 trans_mm"><?php echo $current_total_transaction_monthly; ?></td>
                                            <td class="align-middle text-end pe-3 trans_yy"><?php echo $current_total_transaction_yearly; ?></td>
                                        </tr>
                                        <?php 
                                    }
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        </form>
    </div>
</div>
