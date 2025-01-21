<?php



if (isset($_POST['submit']) && isset($_FILES['csv_file'])) {
    $inbound_warehouse = $_POST['warehouse'];
    $file = $_FILES['csv_file'];
    $date_received = $_POST['received_date'];
    $po_id = $_POST['po_id'];
    $_SESSION['inbound_po_id'] = (int)$_POST['po_id'];  // Ensuring it's an integer
    $_SESSION['inbound_received_date'] = htmlspecialchars($_POST['received_date']);
    $_SESSION['inbound_warehouse'] = htmlspecialchars($_POST['warehouse']);

    if ($file['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $file['tmp_name'];
        $fileName = $file['name'];
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        

        if ($fileExtension === 'csv') {
            if (($handle = fopen($fileTmpPath, 'r')) !== false) {
                $rowIndex = 0;

                while (($data = fgetcsv($handle, 1000, ",")) !== false) {
                    if (count($data) >= 9) {
                        [$item, $keyword, $qty, $price, $supplier, $barcode, $batch, $brand, $category, $safety] = $data;
                        $rowIndex++;
                        
                        if (empty($barcode)) {
                            do {
                                // Generate a random 10-digit barcode
                                $barcode = str_pad(mt_rand(0, 9999999999), 10, '0', STR_PAD_LEFT);
                        
                                // Query the database to check if the barcode already exists
                                $query = "SELECT COUNT(*) AS count FROM product WHERE parent_barcode = ?";
                                $stmt = $conn->prepare($query);
                                $stmt->bind_param("s", $barcode); // Bind the barcode as a string
                                $stmt->execute();
                                $stmt->bind_result($count);
                                $stmt->fetch();
                                $stmt->close();
                            } while ($count > 0); // Regenerate if the barcode already exists
                        }

                        $barcode = "LPO-" . $barcode;
                        ?>
                        <tr>
                            <td>
                                <div class="form-check">
                                    <input 
                                        class="form-check-input" 
                                        type="checkbox" 
                                        name="csv_unique[]" 
                                        value="<?php echo $rowIndex; ?>" 
                                        <?php
                                        if (($item !== "item" && $item !== "ITEM") && ($keyword !== "keyword" && $keyword !== "Keyword")) {
                                        ?>
                                            checked
                                        <?php 
                                        }
                                        ?>

                                    />
                                </div>
                            </td>
                            <td>
                                <input class="form-control" name="item[]" type="text" value="<?php echo $item; ?>">
                                <div class="valid-feedback">Will be registered as new.</div>
                                <div class="invalid-feedback">Product Exist</div>
                            </td>
                            <td>
                                <input class="form-control" name="keyword[]" type="text" value="<?php echo $keyword;?>">
                            </td>
                            <td>
                                <input class="form-control" name="qty[]" type="text" value="<?php echo $qty; ?>">
                            </td>
                            <td>
                                <input class="form-control" name="price[]" type="text" value="<?php echo $price; ?>">
                            </td>
                            <td>
                                <input class="form-control" name="supplier[]" type="text" value="<?php echo $supplier; ?>">
                                <div class="valid-feedback">Will be registered as new.</div>
                                <div class="invalid-feedback">Supplier already exist</div>
                            </td>
                            <td>
                                <input class="form-control" name="barcode[]" type="text" value="<?php echo $barcode; ?>">
                            </td>
                            <td>
                                <input class="form-control" name="batch[]" type="text" value="<?php echo $batch; ?>">
                                <div class="valid-feedback">Will be registered as new.</div>
                                <div class="invalid-feedback">Batch already exist</div>
                            </td>
                            <td>
                                <input class="form-control" name="brand[]" type="text" value="<?php echo $brand; ?>">
                                <div class="valid-feedback">Will be registered as new.</div>
                                <div class="invalid-feedback">Brand name already exist</div>
                            </td>
                            <td>
                                <input class="form-control" name="category[]" type="text" value="<?php echo $category; ?>">
                                <div class="valid-feedback">Will be registered as new.</div>
                                <div class="invalid-feedback">Category name already exist</div>
                            </td>
                            <td>
                                <input class="form-control" name="safety[]" type="number" value="<?php echo $safety; ?>">
                            </td>
                        </tr>
                        <?php
                    }
                }

                fclose($handle);
            } else {
                echo "<tr><td colspan='10'>Error opening the file.</td></tr>";
            }
        } else {
            echo "<tr><td colspan='10'>Invalid file type. Please upload a CSV file.</td></tr>";
        }
    } else {
        echo "<tr><td colspan='10'>Error uploading the file.</td></tr>";
    }
}
?>