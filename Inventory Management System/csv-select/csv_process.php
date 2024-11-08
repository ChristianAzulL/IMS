<?php
// Include necessary files for database connection and session handling
include '../config/database.php';
include '../config/on_session.php';

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

        // Handle $brand (check if it's an integer or string)
        if (is_int($brand)) {
            // If $brand is an integer, get brand name from 'brand' table
            $sql = "SELECT brand_name FROM brand WHERE id = $brand";
            $result = $conn->query($sql);
            if ($row = $result->fetch_assoc()) {
                $brand_id = $row['id'];
                $brand_name = $row['brand_name'];
            }
        } else {
            // If $brand is a string, assign $brand_name
            $brand_name = $brand;
            // Insert into 'brand' table if it's a new brand
            $sql = "INSERT INTO brand (brand_name) VALUES ('$brand_name')";
            $conn->query($sql);
            $brand_id = $conn->insert_id;
        }

        // Handle $category (check if it's an integer or string)
        if (is_int($category)) {
            // If $category is an integer, get category name from 'category' table
            $sql = "SELECT category_name FROM category WHERE id = $category";
            $result = $conn->query($sql);
            if ($row = $result->fetch_assoc()) {
                $category_id = $row['id'];
                $category_name = $row['category_name'];
            }
        } else {
            // If $category is a string, assign $category_name
            $category_name = $category;
            // Insert into 'category' table if it's a new category
            $sql = "INSERT INTO category (category_name) VALUES ('$category_name')";
            $conn->query($sql);
            $category_id = $conn->insert_id;
        }

        // Handle $supplier (check if it's an integer or string)
        if (is_int($supplier)) {
            // If $supplier is an integer, get supplier name from 'supplier' table
            $sql = "SELECT supplier_name FROM supplier WHERE id = $supplier";
            $result = $conn->query($sql);
            if ($row = $result->fetch_assoc()) {
                $supplier_id = $row['id'];
                $supplier_name = $row['supplier_name'];
            }
        } else {
            // If $supplier is a string, assign $supplier_name
            $supplier_name = $supplier;
            // Insert into 'supplier' table if it's a new supplier
            $sql = "INSERT INTO supplier (supplier_name) VALUES ('$supplier_name')";
            $conn->query($sql);
            $supplier_id = $conn->insert_id;
        }

        // Insert into product table if $brand or $category is a string
        if (is_string($brand) || is_string($category)) {
            $sql = "INSERT INTO product (`description`, brand, category, parent_barcode) 
                    VALUES ('$item', '$brand_id', '$category_id', '$barcode')";
            $conn->query($sql);
            $product_id = $conn->insert_id;
        } 

        if (is_int($brand) || is_int($category)) {
            $query = "SELECT * FROM product WHERE `description` = '$item' AND brand = '$brand' AND category = '$category' LIMIT 1";
            $result = $conn->query($query);
            if($result->num_rows>0){
                $row=$result->fetch_assoc();
                $product_id = $row['id'];
            } else {
                $sql = "INSERT INTO product (`description`, brand, category, parent_barcode) 
                    VALUES ('$item', '$brand_id', '$category_id', '$barcode')";
                $conn->query($sql);
                $product_id = $conn->insert_id;
            }
        }

        // Simulate saving data or performing database operations here
        // Example: $stmt = $conn->prepare("INSERT INTO products ...");
        // Execute the query or update accordingly
        $success++; // Increment success if you handle it (e.g., inserted a row)

        for($i=1; $i<=$quantity; $i++){
            $data = "borat<br>";
            $pdfname = $batch . " | " . $barcode . "-" . $i . " " . $item . ".pdf";
            $unique_barcode = $barcode . "-" . $i;
            include "../config/generate-pdf.php";

            $pdfData = $conn->real_escape_string($pdfData);

            $sql = "INSERT INTO stocks (`unique_barcode`, `product_id`, `parent_barcode`, `batch_code`, `capital`, `warehouse`, `supplier`, `date`, `user_id`, `pdf`)
                VALUES ('$unique_barcode','$product_id','$barcode','$batch','$price','1','$supplier_id','$currentDateTime','$user_id','$pdfData')";
            if($conn->query($sql) === TRUE){

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
