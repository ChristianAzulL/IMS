<?php  
$selected_warehouse_id = $_SESSION['selected_warehouse_id'];
$selected_warehouse_name = $_SESSION['selected_warehouse_name'];
?>

<div class="card">
    <div class="card-header bg-warning">
        <h2 class="text-white">Confirmation of Orders</h2>
        <p class="text-white">Please confirm your orders then select your supplier.</p>
    </div>
    <div class="card-body overflow-hidden py-6 px-2">
        <form action="../config/create_po.php" method="POST">
            <div class="card shadow-none">
                <div class="card-body p-0 pb-3" data-list='{"valueNames":["desc","barcode","brand","cat","qty"]}'>
                    <div class="d-flex align-items-center justify-content-end my-3">
                        <div id="undo-container" class="mb-3 d-none col-auto me-1">
                            <button id="undo-btn" class="btn btn-warning btn-sm" type="button">Undo Remove</button>
                        </div>

                        <div class="col-auto text-end mb-3 me-1">
                            <select class="form-select" name="supplier" required>
                                <option value="">Select Supplier</option>
                                <?php 
                                $supplier_query = "SELECT * FROM supplier ORDER BY supplier_name ASC";
                                $supplier_res = $conn->query($supplier_query);
                                if ($supplier_res->num_rows > 0) {
                                    while ($supplier_row = $supplier_res->fetch_assoc()) {
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
                        <table class="table mb-0 table-sm">
                            <thead class="bg-200">
                                <tr>
                                    <th width="50"></th>
                                    <th class="text-black fs-11 dark__text-white align-middle sort" data-sort="desc">Description</th>
                                    <th class="text-black fs-11 dark__text-white align-middle sort" data-sort="desc">Parent Barcode</th>
                                    <th class="text-black fs-11 dark__text-white align-middle sort" data-sort="barcode">Brand</th>
                                    <th class="text-black fs-11 dark__text-white align-middle sort" data-sort="cat">Category</th>
                                    <th class="text-black fs-11 dark__text-white align-middle sort" style="min-width: 250px;" hidden>Supplier</th>
                                    <th class="text-black fs-11 dark__text-white align-middle sort" style="min-width: 150px;">Order Quantity</th>
                                    <th class="text-black fs-11 dark__text-white align-middle white-space-nowrap pe-3 sort" data-sort="qty">Quantity</th>
                                </tr>
                            </thead>
                            <tbody id="bulk-select-body" class="list" data-sortable="data-sortable">
                                <?php 
                                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                    if (isset($_POST['product_id']) && is_array($_POST['product_id'])) {
                                        foreach ($_POST['product_id'] as $product_key => $selectedProductId) {
                                            $product_id = $_POST['product_id'][$product_key];
                                            $product_des = $_POST['product_desc'][$product_key];
                                            $product_pbarcode = $_POST['parent_barcode'][$product_key];
                                            $product_brand = $_POST['brand'][$product_key];
                                            $product_category = $_POST['category'][$product_key];
                                            $current_stock = $_POST['qty'][$product_key];
                                            ?>
                                            <tr class="sortable-item">
                                                <td>
                                                    <button class="btn btn-transparent fs-11 py-0 px-2 delete-btn" target-id="<?php echo $product_id;?>" type="button"><span class="fas fa-window-close"></span></button>
                                                </td>
                                                <th class="align-middle fs-11 desc"><?php echo $product_des; ?></th>
                                                <th class="align-middle fs-11 barcode"><?php echo $product_pbarcode; ?></th>
                                                <td class="align-middle fs-11 brand"><?php echo $product_brand; ?></td>
                                                <td class="align-middle fs-11 cat"><?php echo $product_category; ?></td>
                                                <td class="align-middle fs-11 cat" hidden>
                                                    <input type="text" name="product_id[]" value="<?php echo $product_id;?>" hidden>
                                                    <input type="text" name="parent_barcode[]" value="<?php echo $product_pbarcode;?>" hidden>
                                                    <input type="text" name="product_desc[]" value="<?php echo $product_des;?>" hidden>
                                                    <input type="text" name="brand[]" value="<?php echo $product_brand;?>" hidden>
                                                    <input type="text" name="category[]" value="<?php echo $product_category;?>" hidden>
                                                </td>
                                                <td class="align-middle fs-11 cat table-primary">
                                                    <input type="number" name="order_qty[]" class="form-control bg-danger fs-11 text-white" min="0" placeholder="Order Qty">
                                                </td>
                                                <td class="align-middle fs-11 white-space-nowrap text-end pe-3 qty"><?php echo $current_stock; ?></td>
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
<script>
    let lastDeletedRow = null;
    let lastDeletedIndex = null;

    document.querySelectorAll('.delete-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const row = this.closest('tr');
            const tbody = row.parentNode;

            // Store for undo
            lastDeletedRow = row.cloneNode(true);
            lastDeletedIndex = [...tbody.children].indexOf(row);

            // Remove the row
            row.remove();

            // Show undo button
            document.getElementById('undo-container').classList.remove('d-none');
        });
    });

    document.getElementById('undo-btn').addEventListener('click', function() {
        if (lastDeletedRow !== null) {
            const tbody = document.querySelector('#bulk-select-body');

            // Re-insert the row at its original index
            if (lastDeletedIndex >= tbody.children.length) {
                tbody.appendChild(lastDeletedRow);
            } else {
                tbody.insertBefore(lastDeletedRow, tbody.children[lastDeletedIndex]);
            }

            // Re-bind delete button inside the restored row
            lastDeletedRow.querySelector('.delete-btn').addEventListener('click', function() {
                const row = this.closest('tr');
                lastDeletedRow = row.cloneNode(true);
                lastDeletedIndex = [...tbody.children].indexOf(row);
                row.remove();
                document.getElementById('undo-container').classList.remove('d-none');
            });

            // Reset undo state
            lastDeletedRow = null;
            lastDeletedIndex = null;

            // Hide the undo container
            document.getElementById('undo-container').classList.add('d-none');
        }
    });
</script>
