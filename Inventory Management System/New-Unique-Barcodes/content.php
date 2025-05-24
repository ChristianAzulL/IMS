<?php
$unique_key = $_SESSION['unique_key'];

?>
<div class="card mb-1">
    <div class="card-header bg-warning">
        <h2 class="text-white">Download Barcode/s</h2>
        <div class="row mb-3">
            <div class="col-12 text-end">
                <a class="btn btn-primary btn-sm mt-3" href="../set-item-locations/"><span class="fas fa-home me-2"></span>Set item locations.</a>
            </div>
        </div>
    </div>
    <div class="card-body overflow-hidden">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table table-sm fs-10">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Sequence</th>
                                <th>Parent Barcode</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            // Query to fetch the required data
                            $query = "SELECT 
                                        p.description,
                                        p.parent_barcode,
                                        b.brand_name,
                                        c.category_name,
                                        COUNT(s.parent_barcode) AS item_qty
                                    FROM stocks s
                                    LEFT JOIN product p ON p.hashed_id = s.product_id
                                    LEFT JOIN brand b ON b.hashed_id = p.brand
                                    LEFT JOIN category c ON c.hashed_id = p.category
                                    WHERE s.unique_key = '$unique_key'
                                    GROUP BY s.parent_barcode
                                    ORDER BY s.barcode_extension DESC
                            ";

                            $result = $conn->query($query);

                            // Group data by parent barcode
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $parentBarcode = $row['parent_barcode'];
                                    $brandName = $row['brand_name'];
                                    $categoryName = $row['category_name'];
                                    $description = $row['description'] . " / " . $brandName . " / " . $categoryName;
                                    $totalCount = $row['item_qty'];



                                    $sequence_query = "SELECT barcode_extension FROM stocks WHERE unique_key = '$unique_key' AND parent_barcode = '$parentBarcode' ORDER BY barcode_extension LIMIT 1";
                                    $sequence_result = $conn->query($sequence_query);
                                    if($sequence_result->num_rows>0){
                                        $row=$sequence_result->fetch_assoc();
                                        $barcode_extension = $row['barcode_extension'];
                                    }
                                    $batch_size = 100;
                                    $max = $barcode_extension + $totalCount -1;
                                    for($start=$barcode_extension; $start < $max; $start += $batch_size){
                                        $end = min($batch_size + $start -1, $max);
                                        echo "<tr>
                                                <td><a href='../config/generate-uniquebarcodes.php?success=0&barcode={$parentBarcode}&start={$start}&end={$end}'><span class='fas fa-download'></span> {$description}</a></td>
                                                <td>{$start}-{$end}</td>
                                                <td>{$parentBarcode}</td>
                                                </tr>";
                                    }
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
