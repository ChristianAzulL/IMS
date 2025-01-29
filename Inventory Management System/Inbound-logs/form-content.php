<?php
include "../config/database.php";
include "../config/on_session.php";
if (isset($_GET['id'])) {
    $unique_key = htmlspecialchars($_GET['id']);
    
    $SQL = "SELECT il.*, w.warehouse_name, u.user_fname, u.user_lname, s.supplier_name, up.position_name, s.local_international
            FROM inbound_logs il
            LEFT JOIN supplier s ON s.hashed_id = il.supplier
            LEFT JOIN  users u ON u.hashed_id = il.user_id
            LEFT JOIN warehouse w ON w.hashed_id = il.warehouse
            LEFT JOIN user_position up ON up.hashed_id = u.user_position
            WHERE il.unique_key = '$unique_key'
            LIMIT 1";
    $res = $conn->query($SQL);
    if($res->num_rows>0){
        $row = $res -> fetch_assoc();
        $inbound_warehouse_name = $row['warehouse_name'];
        $inbound_supplier_name = $row['supplier_name'];
        $inbound_receiver = $row['user_fname'] . " " . $row['user_lname'];
        $inbound_receiver_pos = $row['position_name'];
        $supplier_info = $row['local_international'];
        $date_received = $row['date_received']; //sample: 2025-01-01 00:00:00
        $date_received = new DateTime($date_received);
        $date_received = $date_received->format('F j, Y'); // Output: January 1, 2025
    }
    ?>
    <style>
        .header { text-align: center; margin-bottom: 20px; }
    </style>
    <div class="rounded-top-3 py-3 ps-4 pe-6 bg-info">
        <h4 class="mb-1" id="modalExampleDemoLabel">Inbound #: <?php echo $unique_key; ?></h4>
    </div>
    <div class="p-4 pb-0">
        <div class="container">
            <div class="document-container">
                <div class="header">
                    <h2>Inbound Document</h2>
                    <p><strong>Reference No:</strong> <?php echo $unique_key; ?></p>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <h5>Sender Details</h5>
                        <p class="mb-0 mt-0"><strong>Name:</strong> <?php echo $inbound_supplier_name;?></p>
                        <p class="mb-0 mt-0"><strong>Address:</strong> <?php echo $supplier_info;?></p>
                        <p class="mb-0 mt-0"><strong>Date Received:</strong> <?php echo $date_received; ?></p>
                    </div>
                </div>
                
                <h5 class="mt-4">Item Details</h5>
                <div class="table-responsive">
                    <table class="table table-bordered table-sm">
                        <thead class="table-primary">
                            <tr>
                                <th>#</th>
                                <th>Item Name</th>
                                <th>Brand</th>
                                <th>Category</th>
                                <th>Parent Barcode</th>
                                <th class="text-end">Quantity</th>
                                <th class="text-end">Unit Price</th>
                                <th class="text-end">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Laptop</td>
                                <td>Brand</td>
                                <td>Category</td>
                                <td>Parent Barcode</td>
                                <td class="text-end">5</td>
                                <td class="text-end">$800</td>
                                <td class="text-end">$4000</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Monitor</td>
                                <td>Brand</td>
                                <td>Category</td>
                                <td>Parent Barcode</td>
                                <td class="text-end">3</td>
                                <td class="text-end">$200</td>
                                <td class="text-end">$600</td>
                            </tr>
                        </tbody>
                        <tfoot class="table-info">
                            <tr>
                                <td class="text-end" colspan="7"><strong>Total</strong></td>
                                <td class="text-end"><strong>$4600</strong></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                
                <div class="row mt-4 mb-4">
                    <div class="col-md-6">
                        <h5>Received By</h5>
                        <p class="mb-0 mt-0"><u><?php echo $inbound_receiver;?></u></p>
                        <p class="mb-0 mt-0"><?php echo $inbound_receiver_pos;?></p>
                        <b class="mb-0 mt-0"><small> <?php echo $inbound_warehouse_name;?></small></b>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    <?php
}
