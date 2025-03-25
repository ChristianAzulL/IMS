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
                // Read the first row (header)
                $header = fgetcsv($handle, 1000, ",");
                // Expected headers
                $expectedHeaders = ["description", "keyword", "qty", "price", "supplier", "parent barcode", "batch code", "brand", "category", "safety"];

                if ($header !== $expectedHeaders) {
                    echo "<script>
                        document.addEventListener('DOMContentLoaded', function() {
                            var alertButton = document.getElementById('alert-button');
                            if (alertButton) {
                                alertButton.click();
                            } else {
                                alert('CSV headers are incorrect!');
                            }
                        });
                    </script>";
                }
                


                $rowIndex = 0;

                while (($data = fgetcsv($handle, 1000, ",")) !== false) {
                    if (count($data) >= 9) {
                        [$item, $keyword, $qty, $price, $supplier, $barcode, $batch, $brand, $category, $safety] = $data;
                        $rowIndex++;
                        
                        $check_product = "SELECT p.description, p.keyword, p.parent_barcode, b.brand_name, c.category_name
                                            FROM product p
                                            LEFT JOIN brand b ON b.hashed_id = p.brand
                                            LEFT JOIN category c ON c.hashed_id = p.category
                                            WHERE p.description = '$item' AND b.brand_name = '$brand' AND c.category_name = '$category' LIMIT 1";
                        $result = $conn->query($check_product);
                        if($result->num_rows>0){
                            $row=$result->fetch_assoc();
                            $barcode = $row['parent_barcode'];
                        } elseif (empty($barcode)) {
                            
                            do {
                                //generate 7 digit number
                                $barcode = str_pad(mt_rand(0, 9999), 4, '0', STR_PAD_LEFT);
                        
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

                        $check_batch_code = "SELECT batch_code FROM stocks WHERE batch_code = '$batch' LIMIT 1";
                        $check_batch_code_res = $conn->query($check_batch_code);
                        
                        if ($check_batch_code_res->num_rows > 0) {
                            echo "<script>
    document.addEventListener('DOMContentLoaded', function() {
        let timeLeft = 5; // Countdown starts from 5 seconds

        Swal.fire({
            icon: 'warning',
            title: 'Batch Code Exists!',
            html: 'You will be redirected back to the previous page in <b>' + timeLeft + '</b> seconds.',
            allowOutsideClick: false,
            showConfirmButton: false, // Hide OK button
            didOpen: () => {
                const swalContainer = Swal.getHtmlContainer();
                
                // Update countdown every second
                const timerInterval = setInterval(() => {
                    timeLeft--;
                    if (timeLeft >= 0) {
                        swalContainer.innerHTML = 'You will be redirected back to the previous page in <b>' + timeLeft + '</b> seconds.';
                    }
                }, 1000);

                // Redirect after 5 seconds
                setTimeout(() => {
                    clearInterval(timerInterval); // Stop countdown updates
                    window.location.href = document.referrer || '../Inbound-logs/'; // Redirect
                }, 5000);
            }
        });
    });
</script>";

                        }
                        

                        

                        

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