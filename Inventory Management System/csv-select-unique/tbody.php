<?php
if (isset($_POST['submit']) && isset($_FILES['csv_file'])) {
    $inbound_warehouse = $_POST['warehouse'];
    $file = $_FILES['csv_file'];
    $date_received = $_POST['received_date'];
    $_SESSION['inbound_po_id'] = 0;  // Ensuring it's an integer
    $_SESSION['inbound_received_date'] = htmlspecialchars($_POST['received_date']);
    $_SESSION['inbound_warehouse'] = htmlspecialchars($_POST['warehouse']);

    if ($file['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $file['tmp_name'];
        $fileName = $file['name'];
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        
        if ($fileExtension === 'csv') {
            if (($handle = fopen($fileTmpPath, 'r')) !== false) {
                $rows = [];
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
                                $stmt->bind_param("s", $barcode);
                                $stmt->execute();
                                $stmt->bind_result($count);
                                $stmt->fetch();
                                $stmt->close();
                            } while ($count > 0);
                        }

                        // Store the row in an array
                        $rows[] = [
                            'index' => $rowIndex,
                            'item' => $item,
                            'keyword' => $keyword,
                            'qty' => $qty,
                            'price' => $price,
                            'supplier' => $supplier,
                            'barcode' => $barcode,
                            'batch' => $batch,
                            'brand' => $brand,
                            'category' => $category,
                            'safety' => $safety
                        ];
                    }
                }
                fclose($handle);

                // Sort the rows by barcode (Ascending Order)
                usort($rows, function($a, $b) {
                    return strcmp($a['barcode'], $b['barcode']);
                });

                // Display sorted rows
                foreach ($rows as $row) {
                    ?>
                    <tr>
                        <td>
                            <div class="form-check">
                                <input 
                                    class="form-check-input" 
                                    type="checkbox" 
                                    name="csv_unique[]" 
                                    value="<?php echo $row['index']; ?>" 
                                    <?php if ((is_numeric($row['price']) || is_numeric($row['qty']))) echo 'checked'; ?>
                                />
                            </div>
                        </td>
                        <td><input class="form-control" name="item[]" type="text" value="<?php echo $row['item']; ?>"></td>
                        <td><input class="form-control" name="keyword[]" type="text" value="<?php echo $row['keyword']; ?>"></td>
                        <td><input class="form-control" name="qty[]" type="text" value="1"></td>
                        <td><input class="form-control" name="price[]" type="text" value="<?php echo $row['price']; ?>"></td>
                        <td><input class="form-control" name="supplier[]" type="text" value="<?php echo $row['supplier']; ?>"></td>
                        <td><input class="form-control" name="barcode[]" type="text" value="<?php echo $row['barcode']; ?>"></td>
                        <td><input class="form-control" name="batch[]" type="text" value="<?php echo $row['batch']; ?>"></td>
                        <td><input class="form-control" name="brand[]" type="text" value="<?php echo $row['brand']; ?>"></td>
                        <td><input class="form-control" name="category[]" type="text" value="<?php echo $row['category']; ?>"></td>
                        <td><input class="form-control" name="safety[]" type="number" value="<?php echo $row['safety']; ?>"></td>
                    </tr>
                    <?php
                }
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
