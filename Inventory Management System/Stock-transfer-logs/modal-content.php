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
            $dateSent = '<b class="text-danger">?!</b>';
        } else {
            $dateSent = $row['date_out'];
        }
        // Get the warehouse names
        $fromWarehouseQuery = "SELECT warehouse_name FROM warehouse WHERE hashed_id = '$fromWarehouse' LIMIT 1";
        $fromWarehouseResult = $conn->query($fromWarehouseQuery);
        $fromWarehouseName = ($fromWarehouseResult && $fromWarehouseResult->num_rows > 0) ? $fromWarehouseResult->fetch_assoc()['warehouse_name'] : '<b class="text-danger">?!</b>';

        $toWarehouseName = '<b class="text-danger">?!</b>';
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
                            $product_query = "SELECT * 
                                                FROM stock_transfer_content stc
                                                LEFT JOIN stocks s ON s.unique_barcode = stc.unique_barcode
                                                LEFT JOIN product p ON p.hashed_id = s.product_id
                                                LEFT JOIN brand b ON b.hashed_id = p.brand
                                                LEFT JOIN category c ON c.hashed_id = p.category
                                                WHERE stc.st_id = '$getid'
                                            ";
                            ?>
                            <tr class="border-bottom border-200">
                                <td>
                                <div class="d-flex align-items-center position-relative">
                                    <img class="rounded-1 border border-200" src="assets/img/products/12.png" width="60" alt="" />
                                    <div class="flex-1 ms-3">
                                    <h6 class="mb-1 fw-semi-bold">
                                        <a class="text-1100 stretched-link" href="#!">Acer Charger</a>
                                    </h6>
                                    <p class="fw-semi-bold mb-0 text-500">Landing</p>
                                    </div>
                                </div>
                                </td>
                                <td class="align-middle text-end fw-semi-bold">311</td>
                                <td class="align-middle pe-x1">
                                <div class="d-flex align-items-center">
                                    <div class="progress me-3 rounded-3 bg-200" style="height: 5px; width:80px;" role="progressbar" aria-valuenow="39" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar rounded-pill" style="width: 39%;"></div>
                                    </div>
                                </div>
                                </td>
                            </tr>

                            
                            
                            
                            </tbody>
                        </table>
                        </div>
                    </div>
                    <div class="card-footer bg-body-tertiary py-2">
                        <div class="row flex-between-center">
                        <div class="col-auto">
                            <select class="form-select form-select-sm">
                            <option>Last 7 days</option>
                            <option>Last Month</option>
                            <option>Last Year</option>
                            </select>
                        </div>
                        <div class="col-auto">
                            <a class="btn btn-sm btn-falcon-default" href="#!">View All</a>
                        </div>
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