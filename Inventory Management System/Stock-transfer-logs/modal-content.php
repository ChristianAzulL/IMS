<?php
include "../config/database.php";

if (isset($_GET['id'])) {
    $getid = $conn->real_escape_string($_GET['id']);

    $query = "SELECT * FROM stock_transfer WHERE id = '$getid' LIMIT 1";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();

        $fromWarehouse = $row['from_warehouse'];
        $toWarehouse = $row['to_warehouse'] ?? null;
        $status = $row['status'];
        $fromUserId = $row['from_userid'];
        $receivedUserId = $row['received_userid'] ?? null;
        $dateSent = $row['date_out'];
        $dateReceived = $row['date_received'];
        $remarksSender = $row['remarks_sender'];

        if(!isset($row['date_out'])){
            $dateSent = '<b class="text-danger">Current Time</b>';
        } else {
            $dateSent = $row['date_out'];
        }
        // Get the warehouse names
        $fromWarehouseQuery = "SELECT warehouse_name FROM warehouse WHERE hashed_id = '$fromWarehouse' LIMIT 1";
        $fromWarehouseResult = $conn->query($fromWarehouseQuery);
        $fromWarehouseName = ($fromWarehouseResult && $fromWarehouseResult->num_rows > 0) ? $fromWarehouseResult->fetch_assoc()['warehouse_name'] : '<b class="text-danger">?!</b>';

        $toWarehouseName = '<select name="to_warehouse" class="form-select" id=""></select>' ;
        if (!empty($toWarehouse)) {
            $toWarehouseQuery = "SELECT warehouse_name FROM warehouse WHERE hashed_id = '$toWarehouse' LIMIT 1";
            $toWarehouseResult = $conn->query($toWarehouseQuery);
            if ($toWarehouseResult && $toWarehouseResult->num_rows > 0) {
                $toWarehouseName = $toWarehouseResult->fetch_assoc()['warehouse_name'];
            }
        }

        // Get the user full names
        $fromUserQuery = "SELECT CONCAT(user_fname, ' ', user_lname) AS fullname FROM users WHERE hashed_id = '$fromUserId' LIMIT 1";
        $fromUserResult = $conn->query($fromUserQuery);
        $fromFullname = ($fromUserResult && $fromUserResult->num_rows > 0) ? $fromUserResult->fetch_assoc()['fullname'] : '<b class="text-danger">?!</b>';

        $receiverName = '<b class="text-danger">?!</b>';
        if (!empty($receivedUserId)) {
            $toUserQuery = "SELECT CONCAT(user_fname, ' ', user_lname) AS fullname FROM users WHERE hashed_id = '$receivedUserId' LIMIT 1";
            $toUserResult = $conn->query($toUserQuery);
            if ($toUserResult && $toUserResult->num_rows > 0) {
                $receiverName = $toUserResult->fetch_assoc()['fullname'];
            }
        }

        // Status badge
        $statusBadge = match ($status) {
            "pending" => '<span class="badge bg-primary">Pending</span>',
            "enroute" => '<span class="badge bg-warning">Enroute</span>',
            "received" => '<span class="badge bg-success">Received</span>',
            default => '<span class="badge bg-danger">Failed</span>',
        };
        ?>
        <div class="card overflow-hidden" >
        <div class="card-img-top text-center bg-dark"><img class="img-fluid" src="../../assets/img/sample/pending.jpg" alt="Card image cap" /></div>
        <div class="card-body">
            <h5 class="card-title"><?php echo $statusBadge;?></h5>
            <div class="table-responsive">
                <table class="table bordered-table table-bordered">
                    <tr>
                        <th>From</th>
                        <th>Processed by</th>
                        <th>Date Out</th>
                    </tr>
                    <tr>
                        <td><?php echo $fromWarehouseName;?></td>
                        <td><?php echo $fromFullname;?></td>
                        <td><?php echo $dateSent;?></td>
                    </tr>
                    <tr>
                        <th>To</th>
                        <th>Received By</th>
                        <th>Date Received</th>
                    </tr>
                    <tr>
                        <td><?php echo $toWarehouseName;?></td>
                        <td><?php echo $receiverName;?></td>
                        <td><?php echo $dateReceived;?></td>
                    </tr>
                    <tr>
                        <td colspan="3" class="p-0">
                            <table class="table bordered-table table-bordered">
                                <tr>
                                    <th>Sender Remarks</th>
                                    <th>Receiver Remarks</th>
                                </tr>
                                <tr>
                                    <td><?php echo $remarksSender;?></td>
                                    <td><?php echo $remarksSender;?></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="row">
                <!--  Products Table -->
                <div class="col-lg-12 mb-3">
                    <div class="card h-lg-100 overflow-hidden">
                    <div class="card-body p-0">
                        <div class="table-responsive scrollbar">
                        <table class="table table-dashboard mb-0 table-borderless fs-10 border-200">
                            <thead class="bg-body-tertiary">
                            <tr>
                                <th class="text-900">Sent Products</th>
                                <th class="text-900 text-end"></th>
                                <th class="text-900 pe-x1 text-end" style="width: 8rem">(pcs)</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php 
                            $product_query = "
                                SELECT 
                                    stc.unique_barcode, 
                                    stc.status AS stc_status, 
                                    p.product_img, 
                                    p.description, 
                                    s.parent_barcode, 
                                    b.brand_name, 
                                    c.category_name, 
                                    COUNT(*) AS total_quantity
                                FROM 
                                    stock_transfer_content stc
                                LEFT JOIN 
                                    stocks s ON s.unique_barcode = stc.unique_barcode
                                LEFT JOIN 
                                    product p ON p.hashed_id = s.product_id
                                LEFT JOIN 
                                    brand b ON b.hashed_id = p.brand
                                LEFT JOIN 
                                    category c ON c.hashed_id = p.category
                                WHERE 
                                    stc.st_id = '$getid'
                                GROUP BY 
                                    s.batch_code, s.product_id
                            ";
                            $product_query_res = $conn->query($product_query);
                            if($product_query_res->num_rows>0){
                                while($row=$product_query_res->fetch_assoc()){
                                    $unique_barcode = $row['unique_barcode'];
                                    $stc_status = $row['stc_status'];
                                    $product_img = $row['product_img'];
                                    $product_description = $row['description'];
                                    $parent_barcode = $row['parent_barcode'];
                                    $brand_name = $row['brand_name'];
                                    $category_name = $row['category_name'];
                                    $total_quantity = $row['total_quantity'];
                                    ?>
                                    <tr class="border-bottom border-200">
                                        <td>
                                        <div class="d-flex align-items-center position-relative">
                                            <img class="rounded-1 border border-200" src="<?php echo $product_img;?>" width="60" alt="" />
                                            <div class="flex-1 ms-3">
                                            <h6 class="mb-1 fw-semi-bold">
                                                <a class="text-1100 stretched-link" href="#!"><?php echo $product_description;?></a>
                                            </h6>
                                            <p class="fw-semi-bold mb-0 text-500">Brand: <?php echo $brand_name;?> | Category: <?php echo $category_name;?></p>
                                            </div>
                                        </div>
                                        </td>
                                        <td class="align-middle text-end fw-semi-bold"><?php echo $total_quantity;?></td>
                                        <td class="align-middle pe-x1">
                                        <div class="d-flex align-items-center">
                                            <div class="progress me-3 rounded-3 bg-200" style="height: 5px; width:80px;" role="progressbar" aria-valuenow="39" aria-valuemin="0" aria-valuemax="100">
                                            <div class="progress-bar rounded-pill" style="width: <?php echo $total_quantity;?>%;"></div>
                                            </div>
                                        </div>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                       
                            ?>

                            
                            
                            
                            </tbody>
                        </table>
                        </div>
                    </div>
                    
                    </div>
                </div>
            </div>
        </div>
        </div>
        <?php
    } else {
        echo "<p>No record found for the provided ID.</p>";
    }
} else {
    echo "<p>ID parameter is missing.</p>";
}
?>