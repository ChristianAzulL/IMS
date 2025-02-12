<?php 
include "../config/database.php";

if (isset($_GET['id'])) {
    $outbound_id = $_GET['id'];

    // Using prepared statements for the first query
    $stmt = $conn->prepare("SELECT u.user_fname, u.user_lname, w.warehouse_name, ol.date_sent, ol.customer_fullname, ol.order_num, ol.order_line_id, lp.logistic_name, c.courier_name
                            FROM outbound_logs ol
                            LEFT JOIN users u ON u.hashed_id = ol.user_id
                            LEFT JOIN warehouse w ON w.hashed_id = ol.warehouse
                            LEFT JOIN logistic_partner lp ON lp.hashed_id = ol.platform
                            LEFT JOIN courier c ON c.hashed_id = ol.courier 
                            WHERE ol.hashed_id = ? LIMIT 1");
    $stmt->bind_param("s", $outbound_id); // Bind the outbound_id variable
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $staff_name = $row['user_fname'] . " " . $row['user_lname'];
        $warehouse_outbound = $row['warehouse_name'];
        $customer_fullname = $row['customer_fullname'];
        $order_num = $row['order_num'];
        $order_line_id = $row['order_line_id'];
        $logistic_name = $row['logistic_name'];
        $courier = $row['courier_name'];
        $date_Sent = $row['date_sent'];
    ?>
    <style>
        .header { 
            text-align: center; 
            margin-bottom: 20px; 
        }
    </style>
    
    <div class="rounded-top-3 py-3 ps-4 pe-6 bg-info">
        <h4 class="mb-1" id="modalExampleDemoLabel">Outbound </h4>
    </div>
    
    <div class="p-4 pb-0">
        <div class="container">
            <div class="document-container">
                <div class="header">
                    <p><strong>Reference No:</strong><?php echo $outbound_id;?></p>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="table-responsive">
                            <table class="table table-sm">
                            <tr>
                                    <th class='text-start fs-10'>Logistic Partner:</th>
                                    <td class='text-start fs-10'><?php echo $logistic_name;?></td>
                                </tr>
                                <tr>
                                    <th class='text-start fs-10'>Courier:</th>
                                    <td class='text-start fs-10'><?php echo $courier;?></td>
                                </tr>
                                <tr>
                                    <th class='text-start fs-10'>Order no.:</th>
                                    <td class='text-start fs-10'><?php echo $order_num;?></td>
                                </tr>
                                <tr>
                                    <th class='text-start fs-10'>Order Line ID:</th>
                                    <td class='text-start fs-10'><?php echo $order_line_id;?></td>
                                </tr>
                                <tr>
                                    <th class='text-start fs-10'>Customer:</th>
                                    <td class='text-start fs-10'><?php echo $customer_fullname;?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-6 text-end">
                        <table class="table table-sm">
                            <tr>
                                <th class='text-start fs-10'>Staff Name:</th>
                                <td class='text-start fs-10'><?php echo $staff_name;?></td>
                            </tr>
                            <tr>
                                <th class='text-start fs-10'>Warehouse:</th>
                                <td class='text-start fs-10'><?php echo $warehouse_outbound;?></td>
                            </tr>
                            <tr>
                                <th class='text-start fs-10'>Outbound date:</th>
                                <td class='text-start fs-10'><?php echo $date_Sent;?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                
                <h5 class="mt-4">Item Details</h5>
                <div class="table-responsive">
                    <table class="table table-bordered table-sm">
                        <thead class="table-primary">
                            <tr>
                                <?php
                                $table_headers = [
                                    '#', 'Item Name', 'Brand', 'Category', 'Fullfilment Status', 'Parent Barcode', 
                                    'Quantity before', 'Quantity', 'Quantity after', 
                                    'Capital', 'Unit Price', 'Profit', 'Total'
                                ];
                                foreach ($table_headers as $header) {
                                    echo "<th class='fs-10 text-end'>{$header}</th>";
                                }
                                ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            // Second query: Using prepared statements and handling result
                            $query = "
                                SELECT p.description, b.brand_name, c.category_name, s.parent_barcode, 
                                       oc.quantity_before, oc.quantity_after, COUNT(s.parent_barcode) AS quantity, 
                                       s.capital, oc.sold_price
                                FROM outbound_content oc
                                LEFT JOIN stocks s ON s.unique_barcode = oc.unique_barcode
                                LEFT JOIN product p ON p.hashed_id = s.product_id
                                LEFT JOIN brand b ON b.hashed_id = p.brand
                                LEFT JOIN category c ON c.hashed_id = p.category
                                WHERE oc.hashed_id = ?
                                GROUP BY s.parent_barcode";
                                
                            $stmt2 = $conn->prepare($query);
                            $stmt2->bind_param("s", $outbound_id);
                            $stmt2->execute();
                            $res = $stmt2->get_result();
                            
                            $count = 1;
                            $total = 0;
                            $total_profit = 0;
                            if ($res->num_rows > 0) {
                                while ($row = $res->fetch_assoc()) {
                                    $productDescription = $row['description'];
                                    $brandName = $row['brand_name'];
                                    $categoryName = $row['category_name'];
                                    $parentBarcode = $row['parent_barcode'];
                                    $quantityBefore = $row['quantity_before'];
                                    $quantityAfter = $row['quantity_after'];
                                    $quantity = $row['quantity'];
                                    $productCapital = $row['capital'];
                                    $soldPrice = $row['sold_price'];
                                    $sub_Total = $quantity * $soldPrice;
                                    $profit = $soldPrice - $productCapital;
                                    $sub_profit = $profit * $quantity;
                                    echo '
                                    <tr>
                                        <td class="fs-10" style="width: 550px;">' . $count . '</td>
                                        <td class="fs-10">' . $productDescription . '</td>
                                        <td class="fs-10">' . $brandName . '</td>
                                        <td class="fs-10">' . $categoryName . '</td>
                                        <td class="fs-10" style="width: 250px;"> Status here</td>
                                        <td class="fs-10" style="width: 250px;">' . $parentBarcode . '</td>
                                        <td class="text-end fs-10" style="width: 250px;">' . $quantityBefore . '</td>
                                        <td class="text-end fs-10" style="width: 250px;">' . $quantity . '</td>
                                        <td class="text-end fs-10" style="width: 250px;">' . $quantityAfter . '</td>
                                        <td class="text-end fs-10" style="width: 250px;">₱ ' . number_format($productCapital, 2) .'</td>
                                        <td class="text-end fs-10" style="width: 250px;">₱ ' . number_format($soldPrice, 2) . '</td>
                                        <td class="text-end fs-10" style="width: 250px;">₱ ' . number_format($sub_profit, 2)  . '</td>
                                        <td class="text-end fs-10" style="width: 250px;">₱ ' . number_format($sub_Total, 2) . '</td>
                                    </tr>
                                    ';
                                    $count++;
                                    $total += $sub_Total;
                                    $total_profit += $sub_profit;
                                }
                            } else {
                                echo "<tr><td colspan='12' class='text-center'>No items found</td></tr>";
                            }
                            ?>
                            
                        </tbody>
                        <tfoot class="table-info">
                            
                            <tr>
                                <td class="text-start fs-10 text-end" colspan="11"><b><i>Total Profit</i></b></td>
                                <td class="text-end fs-10"><strong>₱</strong></td>
                                <td class="text-end fs-10"><b><i>₱<?php echo number_format($total_profit, 2); ?></i></b></td>
                            </tr>

                            <tr>
                                <td class="text-start fs-10 text-end" colspan="11"><b><i>Total Sales</i></b></td>
                                <td class="text-end fs-10"><strong>₱</strong></td>
                                <td class="text-end fs-10"><b><i>₱<?php echo number_format($total, 2); ?></i></b></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <?php
    }
} else {
    echo "You are not authorized here!";
}
?>
