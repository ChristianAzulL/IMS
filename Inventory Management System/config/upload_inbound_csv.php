<?php
include "database.php";
include "on_session.php";



if (isset($_POST['submit'])) {
    $inbound_warehouse = $_POST['warehouse'];
    // Check if the file was uploaded without errors
    if (isset($_FILES['csv_file']) && $_FILES['csv_file']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['csv_file']['tmp_name'];
        $fileName = $_FILES['csv_file']['name'];
        $fileSize = $_FILES['csv_file']['size'];
        $fileType = $_FILES['csv_file']['type'];
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        // Validate the uploaded file type
        if ($fileExtension === 'csv') {
            // Open the uploaded file for reading
            if (($handle = fopen($fileTmpPath, 'r')) !== FALSE) {
                echo "<h3>Contents of the CSV file:</h3>";
                echo "<form>";

                // Loop through each row of the CSV file
                $rowIndex = 0;
                while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                    // Only process rows that contain at least 2 columns
                    if (count($data) >= 2) {
                        $item = $data[0];
                        $keyword = $data[1];
                        $qty = $data[2];
                        $price = $data[3];
                        $supplier = $data[4];
                        $barcode = $data[5];
                        $batch = $data[6];
                        $brand = $data[7];
                        $category = $data[8]; 
                        // $rowIndex++;
                        // echo $rowIndex;
                        $csv_id = $user_email. "-" .$user_id . "-" . $user_position_id . "-" . $inbound_warehouse;
                        $_SESSION['csv_id'] = $csv_id;

                        $supplier_sql = "SELECT id FROM supplier WHERE supplier_name = '$supplier' LIMIT 1";
                        $supplier_res = $conn->query($supplier_sql);
                        if ($supplier_res->num_rows > 0) {
                            $row = $supplier_res->fetch_assoc();
                            $supplier_id = $row['id'];
                        } else {
                            $supplier_id = 0;
                        }

                        $brand_sql = "SELECT id FROM brand WHERE brand_name = '$brand' LIMIT 1";
                        $brand_res = $conn->query($brand_sql);
                        if ($brand_res->num_rows > 0) {
                            $row = $brand_res->fetch_assoc();
                            $brand_id = $row['id'];
                        } else {
                            $brand_id = 0;
                        }

                        $category_sql = "SELECT id FROM category WHERE category_name = '$category' LIMIT 1";
                        $category_res = $conn->query($category_sql);
                        if ($category_res->num_rows > 0) {
                            $row = $category_res->fetch_assoc();
                            $category_id = $row['id'];
                        } else {
                            $category_id = 0;
                        }

                        $product_sql = "SELECT * FROM product WHERE `description` = '$item' OR parent_barcode = '$barcode' LIMIT 1";
                        $product_res = $conn->query($product_sql);
                        if($product_res->num_rows>0){
                            $row=$product_res->fetch_assoc();
                            $product_id = $row['id'];
                        } else {
                            $product_id = 0;
                        }

                        $insert_csv = "INSERT INTO inbound_csv 
                                        SET product_id = '$product_id',
                                            item = '$item',
                                            keyword = '$keyword',
                                            qty = '$qty',
                                            price = '$price',
                                            supplier = '$supplier',
                                            supplier_id = '$supplier_id',
                                            barcode = '$barcode',
                                            batch = '$batch',
                                            brand = '$brand',
                                            brand_id = '$brand_id',
                                            category = '$category',
                                            category_id = '$category_id',
                                            csv_id = '$csv_id',
                                            warehouse = '$inbound_warehouse',
                                            user_id = '$user_id'
                                            ";
                        if($conn->query($insert_csv) === TRUE ){
                            echo "successfully inserted";
                        } else {
                            echo "error inserting product";
                        }

                        

                    }
                }
                echo "</form>";
                fclose($handle);

                header("Location:../csv-select/");
            } else {
                echo "Error opening the file.";
            }
        } else {
            echo "Invalid file type. Please upload a CSV file.";
        }
    } else {
        echo "Error uploading the file.";
    }
}
?>
