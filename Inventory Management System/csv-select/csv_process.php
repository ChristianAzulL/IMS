<?php
// Include necessary files for database connection and session handling
include '../config/database.php';
include '../config/on_session.php';

$unique_key = $_SESSION['unique_key'];
$po_id = $_SESSION['inbound_po_id'];
$received_date = $_SESSION['inbound_received_date'];
$warehouse_inbound = $_SESSION['inbound_warehouse'];


$insert_inbound = "INSERT INTO inbound_logs SET po_id = '$po_id', date_received = '$received_date', user_id = '$user_id', warehouse = '$warehouse_inbound', unique_key = '$unique_key'";
if($conn->query($insert_inbound)===true){
    $inbound_id = $conn->insert_id;
}

// Initialize a response array
$response = ['status' => 'error', 'message' => 'No data submitted.'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $csv_unique = $_POST['csv_unique']; // Array of unique row IDs
    $items = $_POST['item'];
    $keywords = $_POST['keyword'];
    $quantities = $_POST['qty'];
    $prices = $_POST['price'];
    $suppliers = $_POST['supplier'];
    $barcodes = $_POST['barcode'];
    $batches = $_POST['batch'];
    $brands = $_POST['brand'];
    $categories = $_POST['category'];
    $safeties = $_POST['safety'];

    $checkedCount = count($csv_unique); // Count how many checkboxes were checked
    $success = 0;

    foreach ($csv_unique as $index) {
        // Prepare the query for inserting or updating the product
        $item = $items[$index - 1];
        $keyword = $keywords[$index - 1];
        $quantity = $quantities[$index - 1];
        $price = $prices[$index - 1];
        $supplier = $suppliers[$index - 1];
        $barcode = $barcodes[$index - 1];
        $batch = $batches[$index - 1];
        $brand = $brands[$index - 1];
        $category = $categories[$index - 1];
        $safety = $safeties[$index - 1];

        
            $brand_name = $brand;
            $sql = "SELECT * FROM brand WHERE brand_name = '$brand_name' LIMIT 1";
            $result = $conn->query($sql);
            if ($result->num_rows == 0) {
                // Insert into brand table if it doesn't exist
                $sql = "INSERT INTO brand (brand_name, user_id, `date`) VALUES ('$brand_name', '$user_id', '$currentDateTime')";
                $conn->query($sql);
                $brand_id = $conn->insert_id;
                $hashed_brand_id = hash('sha256', $brand_id);
                $update_brand = "UPDATE brand SET hashed_id = '$hashed_brand_id' WHERE id = '$brand_id'";
                $conn->query($update_brand);
            } else {
                $row = $result->fetch_assoc();
                $brand_id = $row['hashed_id'];
                $hashed_brand_id = $brand_id;
            }

        
            $category_name = $category;
            $sql = "SELECT * FROM category WHERE category_name = '$category_name' LIMIT 1";
            $result = $conn->query($sql);
            if ($result->num_rows == 0) {
                // Insert into category table if it doesn't exist
                $sql = "INSERT INTO category (category_name, user_id, `date`) VALUES ('$category_name', '$user_id', '$currentDateTime')";
                $conn->query($sql);
                $category_id = $conn->insert_id;
                $hashed_category_id = hash('sha256', $category_id);
                $update_category = "UPDATE category SET hashed_id = '$hashed_category_id' WHERE id ='$category_id'";
                $conn->query($update_category);
            } else {
                $row = $result->fetch_assoc();
                $category_id = $row['hashed_id'];
                $hashed_category_id = $category_id;
            }


      
            $supplier_name = $supplier;
            $sql = "SELECT * FROM supplier WHERE supplier_name = '$supplier_name' LIMIT 1";
            $result = $conn->query($sql);
            if ($result->num_rows == 0) {
                // Insert into supplier table if it doesn't exist
                $sql = "INSERT INTO supplier (supplier_name, `date`, user_id) VALUES ('$supplier_name', '$currentDateTime', '$user_id')";
                $conn->query($sql);
                $supplier_id = $conn->insert_id;
                $hashed_supplier_id = hash('sha256', $supplier_id);
                $update_supplier = "UPDATE supplier SET hashed_id = '$hashed_supplier_id' WHERE id ='$supplier_id'";
                $conn->query($update_supplier);
            } else {
                $row = $result->fetch_assoc();
                $supplier_id = $row['hashed_id'];
                $hashed_supplier_id = $supplier_id;
            }

        

        
            $query = "SELECT * FROM product WHERE `description` = '$item' AND brand = '$hashed_brand_id' AND category = '$hashed_category_id' LIMIT 1";
            $result = $conn->query($query);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $product_id = $row['id'];
                $hashed_product_id = $row['hashed_id'];
                $update_product = "UPDATE product SET hashed_id = '$hashed_product_id', `safety` = '$safety', keyword = '$keyword' WHERE id ='$product_id'";
                $conn->query($update_product);
            } else {
                $sql = "INSERT INTO product (`description`, brand, category, parent_barcode, `date`, user_id) 
                        VALUES ('$item', '$hashed_brand_id', '$hashed_category_id', '$barcode', '$currentDateTime', '$user_id')";
                $conn->query($sql);
                $product_id = $conn->insert_id;
                $hashed_product_id = hash('sha256', $product_id);
                $update_product = "UPDATE product SET hashed_id = '$hashed_product_id', `safety` = '$safety', keyword = '$keyword' WHERE id ='$product_id'";
                $conn->query($update_product);
            }
        

        // Generate and store unique barcodes for each quantity
        $last_unique_suffix = 0; // Initialize to start fresh if no prior barcodes exist

        // Check the last unique barcode and get its suffix
        $check_unique_barcode = "SELECT unique_barcode 
                                    FROM stocks 
                                    WHERE parent_barcode = '$barcode' 
                                    ORDER BY LPAD(SUBSTRING_INDEX(unique_barcode, '-', -1), 10, '0') DESC 
                                    LIMIT 1;";
        $check_unique_barcode_res = $conn->query($check_unique_barcode);
        if ($check_unique_barcode_res->num_rows > 0) {
            $row = $check_unique_barcode_res->fetch_assoc();
            $last_unique_barcode = $row['unique_barcode'];
            $parts = explode('-', $last_unique_barcode);
            $last_unique_suffix = isset($parts[1]) ? (int)$parts[1] : 0; // Extract numeric suffix
        }

        // Generate new unique barcodes
        for ($i = 1; $i <= $quantity; $i++) {
            $new_suffix = $last_unique_suffix + $i; // Increment suffix
            $unique_barcode = $barcode . '-' . $new_suffix; // Append new suffix

            // Insert the new stock record into the database
            $sql = "INSERT INTO stocks (`unique_barcode`, `product_id`, `parent_barcode`, `batch_code`, `capital`, `warehouse`, `supplier`, `date`, `user_id`, `inbound_id`, `unique_key`) 
                    VALUES ('$unique_barcode', '$hashed_product_id', '$barcode', '$batch', '$price', '$warehouse_inbound', '$hashed_supplier_id', '$currentDateTime', '$user_id', '$inbound_id', '$unique_key')";
            
            if ($conn->query($sql) === TRUE) {
                $stock_id = $conn->insert_id;
                $hash_stock = hash('sha256', $stock_id);
                $update_stock = "UPDATE stocks SET hashed_id = '$hash_stock' WHERE id ='$stock_id'";
                $conn->query($update_stock);
                $success++; // Increment success count if insertion was successful
            } else {
                error_log("Failed to insert stock: " . $conn->error);
            }
        }        
    }

    // Update the response to success if there are any valid changes
    if ($success > 0) {
        $response = [
            'status' => 'success',
            'message' => "$success out of $checkedCount records saved successfully."
        ];
    } else {
        $response = [
            'status' => 'info',
            'message' => 'No valid data to save.'
        ];
    }
}

echo json_encode($response); // Send the structured response
$conn->close();
?>
