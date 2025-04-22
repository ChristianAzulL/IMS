<?php 
include "../config/database.php";
if(isset($_GET['id'])){
    $rts_id = $_GET['id'];
?>
<div class="p-4 pb-0">
    <form>
        <div class="row">
            <div class="col-lg-12">
                <div id="tableExample" data-list='{"valueNames":["name","email","age"],"page":5,"pagination":true}'>
                    <div class="table-responsive scrollbar">
                        <table class="table table-bordered table-striped fs-10 mb-0">
                            <thead class="bg-info">
                                <tr>
                                    <th>#</th>
                                    <th class="text-900 sort" data-sort="name" style="width: 200px;">Item</th>
                                    <th class="text-900 sort" data-sort="name">Brand</th>
                                    <th class="text-900 sort" data-sort="name">Category</th>
                                    <th class="text-900 sort" data-sort="name">Fulfillment Status</th>
                                    <th class="text-900 sort" data-sort="name" style="width: 200px;">Barcode</th>
                                    <th class="text-900 sort" data-sort="name"></th>
                                    
                                </tr>
                            </thead>
                            <tbody class="list">
                                <?php 
                                $sql = "SELECT p.description, b.brand_name, c.category_name, rts.unique_barcode, rts.status, rtsl.for
                                            FROM rts_content rts
                                            LEFT JOIN rts_logs rtsl ON rtsl.id = rts.rts_id
                                            LEFT JOIN stocks s ON s.unique_barcode = rts.unique_barcode
                                            LEFT JOIN product p ON p.hashed_id = s.product_id
                                            LEFT JOIN brand b ON b.hashed_id = p.brand
                                            LEFT JOIN category c ON c.hashed_id = p.category
                                            WHERE rts.rts_id = '$rts_id'
                                            ";
                                $result = $conn->query($sql);
                                if($result->num_rows>0){
                                    $number =0;
                                    while($row=$result->fetch_assoc()){
                                        $product_description = $row['description'];
                                        $brand_name = $row['brand_name'];
                                        $category_name = $row['category_name'];
                                        $barcode = $row['unique_barcode'];
                                        if($row['status'] == 0){
                                            $rts_status = '<span class="badge rounded-pill bg-primary">Returned</span>';
                                        } elseif($row['status'] == 1){
                                            $rts_status = '<span class="badge rounded-pill bg-success">Returned and Refunded</span>';    
                                        } else {
                                            $rts_status = '<span class="badge rounded-pill bg-success">Returned and Replaced</span>';        
                                        }
                                        $number ++;
                                ?>
                                <tr>
                                    <td><?php echo $number;?></td>
                                    <td class="text-900"><?php echo $product_description;?></td>
                                    <td class="text-900"><?php echo $brand_name;?></td>
                                    <td class="text-900"><?php echo $category_name;?></td>
                                    <td class="text-900"><?php echo $rts_status;?></td>
                                    <td class="text-900">
                                        <?php echo $barcode;?>
                                    </td>
                                    
                                    <td class="">
                                        <?php 
                                    if($row['status'] == 0){
                                        if($row['for'] === 'return and replace'){
                                    ?>
                                        <a id="replace-btn" href="../config/returned.php?type=replace&barcode=<?php echo $barcode;?>" class="btn btn-stransparent fs-10 shadow-" data-bs-toggle="tooltip" data-bs-placement="left" title="click if item already replaced!"><span class="fas fa-recycle"></span></a>
                                    <?php
                                        } else {
                                    ?>
                                        <a id="refund-btn" href="../config/returned.php?type=refund&barcode=<?php echo $barcode;?>" class="btn btn-transparent fs-10 shadow-lg" data-bs-toggle="tooltip" data-bs-placement="left" title="click if item already refunded!"><span class="far fa-money-bill-alt"></span> </a>
                                    
                                    <?php 
                                        }
                                    } else {
                                        
                                    }
                                    ?>
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
    </form>
</div>
<?php 
} else {
    echo "burat";
}
?>