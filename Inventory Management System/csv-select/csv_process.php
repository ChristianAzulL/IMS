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

        // Handle brand insertion
        if (is_int($brand)) {
            $sql = "SELECT id FROM brand WHERE id = $brand LIMIT 1";
            $result = $conn->query($sql);
            if ($row = $result->fetch_assoc()) {
                $brand_id = $row['id'];
            }
        } else {
            $brand_name = $brand;
            $sql = "SELECT id FROM brand WHERE brand_name = '$brand_name' LIMIT 1";
            $result = $conn->query($sql);
            if ($result->num_rows == 0) {
                // Insert into brand table if it doesn't exist
                $sql = "INSERT INTO brand (brand_name) VALUES ('$brand_name')";
                $conn->query($sql);
                $brand_id = $conn->insert_id;
                $hashed_brand_id = hash('sha256', $brand_id);
                $update_brand = "UPDATE brand SET hashed_id = '$hashed_brand_id' WHERE id = '$brand_id'";
                $conn->query($update_brand);
            } else {
                $row = $result->fetch_assoc();
                $brand_id = $row['id'];
            }
        }

        // Handle category insertion
        if (is_int($category)) {
            $sql = "SELECT id FROM category WHERE id = $category LIMIT 1";
            $result = $conn->query($sql);
            if ($row = $result->fetch_assoc()) {
                $category_id = $row['id'];
            }
        } else {
            $category_name = $category;
            $sql = "SELECT id FROM category WHERE category_name = '$category_name' LIMIT 1";
            $result = $conn->query($sql);
            if ($result->num_rows == 0) {
                // Insert into category table if it doesn't exist
                $sql = "INSERT INTO category (category_name) VALUES ('$category_name')";
                $conn->query($sql);
                $category_id = $conn->insert_id;
                $hashed_category_id = hash('sha256', $category_id);
                $update_category = "UPDATE category SET hashed_id = '$hashed_category_id' WHERE id ='$category_id'";
                $conn->query($update_category);
            } else {
                $row = $result->fetch_assoc();
                $category_id = $row['id'];
            }
        }

        // Handle supplier insertion
        if (is_int($supplier)) {
            $sql = "SELECT id FROM supplier WHERE id = $supplier LIMIT 1";
            $result = $conn->query($sql);
            if ($row = $result->fetch_assoc()) {
                $supplier_id = $row['id'];
            }
        } else {
            $supplier_name = $supplier;
            $sql = "SELECT id FROM supplier WHERE supplier_name = '$supplier_name' LIMIT 1";
            $result = $conn->query($sql);
            if ($result->num_rows == 0) {
                // Insert into supplier table if it doesn't exist
                $sql = "INSERT INTO supplier (supplier_name) VALUES ('$supplier_name')";
                $conn->query($sql);
                $supplier_id = $conn->insert_id;
                $hashed_supplier_id = hash('sha256', $supplier_id);
                $update_supplier = "UPDATE supplier SET hashed_id = '$hashed_supplier_id' WHERE id ='$supplier_id'";
                $conn->query($update_supplier);
            } else {
                $row = $result->fetch_assoc();
                $supplier_id = $row['id'];
            }
        }

        

        // Check if the product already exists
        if (is_int($brand) && is_int($category)) {
            $hashed_brand = hash('sha256', $brand);
            $hashed_category = hash('sha256', $category);
            $query = "SELECT id FROM product WHERE `description` = '$item' AND brand = '$hashed_brand' AND category = '$hashed_category' LIMIT 1";
            $result = $conn->query($query);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $product_id = $row['id'];
            } else {
                $sql = "INSERT INTO product (`description`, brand, category, parent_barcode) 
                        VALUES ('$item', '$brand_id', '$category_id', '$barcode')";
                $conn->query($sql);
                $product_id = $conn->insert_id;
                $hashed_product_id = hash('sha256', $product_id);
                $update_product = "UPDATE product SET hashed_id = '$hashed_product_id' WHERE id ='$product_id'";
                $conn->query($update_product);
            }
        } else{
                $sql = "INSERT INTO product (`description`, brand, category, parent_barcode) 
                        VALUES ('$item', '$brand_id', '$category_id', '$barcode')";
                $conn->query($sql);
                $product_id = $conn->insert_id;
                $hashed_product_id = hash('sha256', $product_id);
                $update_product = "UPDATE product SET hashed_id = '$hashed_product_id' WHERE id ='$product_id'";
                $conn->query($update_product);
        }

        $product_id = $product_id;
        // Generate and store PDF for each quantity
        for ($i = 1; $i <= $quantity; $i++) {
            $unique_barcode = $barcode . "-" . $i;

            // Dynamic HTML content for the PDF
            $html = "<html><head><style>body { font-family: Arial, sans-serif; }</style></head>";
            $html .= "<body>";
            $html .= "<h1>Product: $item</h1>";
            $html .= "<p>Barcode: $unique_barcode</p>";
            $html .= "<p>Supplier: $supplier_name</p>";
            $html .= "<p>Batch: $batch</p>";
            $html .= "<div class='barcode-container'>";
            $html .= "<img alt='testing' src='../../assets/barcode/barcode.php?codetype=Code128&size=50&text=$unique_barcode&print=true'/>";
            $html .= "</div>";
            $html .= "</body></html>";

            // Initialize mPDF and generate the PDF
            $mpdf = new \Mpdf\Mpdf();
            $mpdf->WriteHTML($html);
            $pdfData = $mpdf->Output('', 'S'); // Get PDF as a string

            // Escape the binary PDF data for insertion into the database
            $pdfData = $conn->real_escape_string($pdfData);

            // Insert into database with the generated PDF data
            $sql = "INSERT INTO stocks (`unique_barcode`, `product_id`, `parent_barcode`, `batch_code`, `capital`, `warehouse`, `supplier`, `date`, `user_id`, `pdf`) 
                    VALUES ('$unique_barcode', '$product_id', '$barcode', '$batch', '$price', '1', '$supplier_id', '$currentDateTime', '$user_id', '$pdfData')";
            if ($conn->query($sql) === TRUE) {
                $stock_id = $conn->insert_id;
                $hash_stock = hash('sha256', $stock_id);
                $update_stock = "UPDATE stocks SET hashed_id = '$hash_stock' WHERE id ='$stock_id'";
                $conn->query($update_stock);
                $success++; // Increment success count if insertion was successful
            } else {
                // Handle error
                error_log("Failed to insert PDF data: " . $conn->error);
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
