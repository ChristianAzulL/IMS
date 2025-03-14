<?php
$unique_key = $_SESSION['unique_key'];
?>
<div class="row mb-3">
    <div class="col-12 text-end">
        <a class="btn btn-primary btn-sm mt-3" href="../set-item-locations/"><span class="fas fa-home me-2"></span>Set item locations.</a>
    </div>
</div>
<div class="card mb-1">
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
                                        s.barcode_extension
                                    FROM stocks s
                                    LEFT JOIN product p ON p.hashed_id = s.product_id
                                    LEFT JOIN brand b ON b.hashed_id = p.brand
                                    LEFT JOIN category c ON c.hashed_id = p.category
                                    WHERE s.unique_key = '$unique_key'
                                    ORDER BY s.barcode_extension DESC
                            ";

                            $result = $conn->query($query);
                            $groupedData = [];

                            // Group data by parent barcode
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $parentBarcode = $row['parent_barcode'];
                                    $brandName = $row['brand_name'];
                                    $categoryName = $row['category_name'];
                                    $description = $row['description'] . " / " . $brandName . " / " . $categoryName;
                                    $barcode_extension = $row['barcode_extension'];

                                    // Store items under the same parent barcode
                                    if (!isset($groupedData[$parentBarcode])) {
                                        $groupedData[$parentBarcode] = [];
                                    }
                                    $groupedData[$parentBarcode][] = $description;
                                }
                            }

                            // Display grouped data with sequence numbering
                            foreach ($groupedData as $parentBarcode => $items) {
                                $totalCount = count($items);
                                $batchSize = 100;
                                $new = true;
                                if($new === true){
                                    $start = $barcode_extension;  // Starting barcode sequence for the first batch
                                } else {
                                    $start = $barcode_extension + 1; 
                                }
                                // Loop through the items and create barcode ranges
                                for ($i = 1; $i < $totalCount; $i += $batchSize) {
                                    if($new===true){
                                        $new = false;
                                    }
                                    $end = min($start + $batchSize - 1, $totalCount);  // Make sure end doesn't exceed total count
                                    echo "<tr>
                                            <td><a href='../config/generate-uniquebarcodes.php?success=0&barcode={$parentBarcode}&start={$start}&end={$end}'><span class='fas fa-download'></span> {$items[0]}</a></td>
                                            <td>{$start}-{$end}</td>
                                            <td>{$parentBarcode}</td>
                                          </tr>";
                                    $start = $end + 1;  // Update the start for the next batch
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
