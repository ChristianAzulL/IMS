<div class="row">
    <div class="col-xxl-12">
        <div class="card">
            <div class="card-body bg-body-tertiary overflow-hidden ">
                <form action="../Transaction-overview propose/index" method="POST">
                    <div class="tab-content row">
                        <div class="col-lg-2 mb-3">
                            <label class="form-label" for="start_datepicker">Start Date</label>
                            <input class="form-control datetimepicker fs-11" name="start_date" id="start_datepicker" type="text" placeholder="dd/mm/yy" data-options='{"disableMobile":true}' required/>
                        </div>
                        <div class="col-lg-2 mb-3">
                            <label class="form-label" for="end_datepicker">End Date</label>
                            <input class="form-control datetimepicker fs-11" name="end_date" id="end_datepicker" type="text" placeholder="dd/mm/yy" data-options='{"disableMobile":true}' required/>
                        </div>
                        <div class="col-lg-4 mb-3">
                            <div class="form-group">
                                <label for="category">Category</label>
                                <select class="form-select selectpicker fs-11" id="category" multiple="multiple" size="1" name="category[]" data-options='{"placeholder":"Select your options"}'>
                                    <option value="">Select staff...</option>
                                    <?php 
                                    $category_sql = "SELECT * FROM category ORDER BY category_name ASC";
                                    $stmt = $conn->prepare($category_sql); // Use prepared statements
                                    $stmt->execute();
                                    $res = $stmt->get_result();
                                    if ($res->num_rows > 0) {
                                        while ($row = $res->fetch_assoc()) {
                                            $category_name = htmlspecialchars($row['category_name'], ENT_QUOTES, 'UTF-8');
                                            $category_id = htmlspecialchars($row['hashed_id'], ENT_QUOTES, 'UTF-8');
                                            echo '<option value="' . $category_id . '">' . $category_name . '</option>'; 
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-2 mb-3">
                            <label for="warehouse">Warehouse</label>
                            <select class="form-select fs-11" name="warehouse" id="warehouse">
                            <?php echo implode("\n", $warehouse_options2); ?>
                            </select>
                        </div>
                        <div class="col-lg-1 mb-3 pt-4">
                            <button type="submit" class="btn btn-primary mt-1 fs-11">Generate</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <table border="1" cellspacing="0" cellpadding="5">
    <thead>
        <tr>
            <td class="fs-11"><b>ORDER #</b></td>
            <td class="fs-11"><b>OUTBOUND #</b></td>
            <td class="fs-11"><b>CUSTOMER</b></td>
            <td class="fs-11"><b>OUTBOUND DATE</b></td>
            <td class="fs-11"><b>SUPPLIER</b></td>
            <td class="fs-11"><b>LOCAL/ IMPORT</b></td>
            <td class="fs-11"><b>DESCRIPTION</b></td>
            <td class="fs-11"><b>BRAND</b></td>
            <td class="fs-11"><b>CATEGORY</b></td>
            <td class="fs-11"><b>BARCODE</b></td>
            <td class="fs-11"><b>BATCH</b></td>
            <td class="fs-11"><b>UNIT COST</b></td>
            <td class="fs-11"><b>GROSS SALE</b></td>
            <td class="fs-11"><b>NET INCOME</b></td>
        </tr>
    </thead>
    <tbody>
        <!-- Add your data rows here -->
        <tr>
            <td>12345</td>
            <td>OUT001</td>
            <td>Customer A</td>
            <td>2025-04-26</td>
            <td>Supplier X</td>
            <td>Local</td>
            <td>Item Description</td>
            <td>Brand Y</td>
            <td>Category Z</td>
            <td>1234567890123</td>
            <td>Batch001</td>
            <td>$10.00</td>
            <td>$15.00</td>
            <td>$5.00</td>
        </tr>
    </tbody>
</table>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Collect inputs safely
        $startDate = isset($_POST['start_date']) ? $_POST['start_date'] . " 23:59:59" : null;
        $endDate = isset($_POST['end_date']) ? $_POST['end_date'] . " 23:59:59" : null;
        $warehouse_transaction = isset($_POST['warehouse']) ? trim($_POST['warehouse']) : '';
        $categories = isset($_POST['category']) ? $_POST['category'] : [];

         // Validate date format
        $startDateObj = DateTime::createFromFormat('d/m/y', $startDate);
        $endDateObj = DateTime::createFromFormat('d/m/y', $endDate);
        $startDateSQL = $startDateObj ? $startDateObj->format('Y-m-d') : null;
        $endDateSQL = $endDateObj ? $endDateObj->format('Y-m-d') . ' 23:59:59' : null;
    
         // Implode raw hashed IDs
        $imploded_category = implode(', ', $categories);
       
    ?>
    <div class="col-xxl-12">
        <div class="card mt-3">
            <div class="card-body bg-body-tertiary">
                <div class="row">
                    <div class="col-lg-11 text-center mb-3">
                        <h3>TRANSACTION OVERVIEW</h3>
                        <h5><?php //echo $outbound_warehouse;?></h5>
                    </div>
                    <div class="col-lg-1">
                        <a href="url.php?from=<?php echo $startDate;?>&to=<?php echo $endDate;?>&staffs=<?php echo $imploded_category;?>&wh=<?php echo $warehouse_transaction;?>" class="btn btn-primary fs-11"><span class="fas fa-download"></span></a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 table-responsive">
                            <!-- <table class="table mb-0 data-table fs-10" data-datatables="data-datatables"> -->
                            <table class="table mb-0 fs-10">
                                <thead class="table-primary">
                                    <tr>
                                        <th class="fs-10">#</th>
                                        <th class="fs-10" colspan="8">CATEGORY</th>
                                        <th class="fs-10">QTY</th>
                                        <th class="fs-10">SUBTOTAL UNIT COST</th>
                                        <th class="fs-10">SUBTOTAL GROSS SALES</th>
                                        <th class="fs-10">SUBTOTAL NET INCOME</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="fs-10"></td>
                                        <td class="fs-10" colspan="8">CATEGORY</td>
                                        <td class="fs-10">QTY</td>
                                        <td class="fs-10">SUBTOTAL UNIT COST</td>
                                        <td class="fs-10">SUBTOTAL GROSS SALES</td>
                                        <td class="fs-10">SUBTOTAL NET INCOME</td>
                                    </tr>
                                    <tr>
                                        <td class="fs-11"><b>ORDER #</b></td>
                                        <td class="fs-11"><b>OUTBOUND #</b></td>
                                        <td class="fs-11"><b>CUSTOMER</b></td>
                                        <td class="fs-11"><b>OUTBOUND DATE</b></td>
                                        <td class="fs-11"><b>SUPPLIER</b></td>
                                        <td class="fs-11"><b>LOCAL/ IMPORT</b></td>
                                        <td class="fs-11"><b>DESCRIPTION</b></td>
                                        <td class="fs-11"><b>BRAND</b></td>
                                        <td class="fs-11"><b>BARCODE</b></td>
                                        <td class="fs-11"><b>BATCH</b></td>
                                        <td class="fs-11"><b>UNIT COST</b></td>
                                        <td class="fs-11"><b>GROSS SALE</b></td>
                                        <td class="fs-11"><b>NET INCOME</b></td>
                                    </tr>
                                    <tr>
                                        <td class="fs-11">ORDER #</td>
                                        <td class="fs-11">OUTBOUND #</td>
                                        <td class="fs-11">CUSTOMER</td>
                                        <td class="fs-11">OUTBOUND DATE</td>
                                        <td class="fs-11">SUPPLIER</td>
                                        <td class="fs-11">LOCAL/ IMPORT</td>
                                        <td class="fs-11">DESCRIPTION</td>
                                        <td class="fs-11">BRAND</td>
                                        <td class="fs-11">BARCODE</td>
                                        <td class="fs-11">BATCH</td>
                                        <td class="fs-11">UNIT COST</td>
                                        <td class="fs-11">GROSS SALE</td>
                                        <td class="fs-11">NET INCOME</td>
                                    </tr>
                                </tbody>
                            </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php 
    }
    ?>
</div>