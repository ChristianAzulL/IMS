<?php
// Include necessary files for database connection and session handling
include '../config/database.php';
include '../config/on_session.php';

$csv_id = $_SESSION['csv_id'];
$currentDateTime = date('Y-m-d H:i:s'); // Define current date and time

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the submitted CSV data
    $csv_unique_ids = $_POST['csv_unique'] ?? [];
    $csv_items = $_POST['csv_item'] ?? [];
    $csv_keywords = $_POST['csv_keyword'] ?? [];
    $csv_qtys = $_POST['csv_qty'] ?? [];
    $csv_prices = $_POST['csv_price'] ?? [];
    $csv_suppliers = $_POST['csv_supplier'] ?? [];
    $csv_supplier_ids = $_POST['supplier_id'] ?? [];
    $csv_barcodes = $_POST['csv_barcode'] ?? [];
    $csv_batches = $_POST['csv_batch'] ?? [];
    $csv_brands = $_POST['csv_brand'] ?? [];
    $csv_categories = $_POST['csv_category'] ?? [];
    $csv_warehouses = $_POST['csv_warehouse'] ?? [];
    $csv_product_ids = $_POST['product_id'] ?? [];
    
    // Prepare a response array
    $response = [
        'success' => [],
        'errors' => []
    ];
    

    // Loop through each entry and process it
    foreach ($csv_unique_ids as $index => $unique_id) {
        // Validate and sanitize input
        $item = $conn->real_escape_string($csv_items[$index]);
        $keyword = $conn->real_escape_string($csv_keywords[$index]);
        $qty = (int)$csv_qtys[$index];
        $price = (float)$csv_prices[$index];
        $supplier = $conn->real_escape_string($csv_suppliers[$index]);
        $supplier_id = $conn->real_escape_string($csv_supplier_ids[$index]);
        $barcode = $conn->real_escape_string($csv_barcodes[$index]);
        $batch = $conn->real_escape_string($csv_batches[$index]);
        $brand = $conn->real_escape_string($csv_brands[$index]);
        $category = $conn->real_escape_string($csv_categories[$index]);
        $warehouse = $conn->real_escape_string($csv_warehouses[$index]);
        $product_id = $conn->real_escape_string($csv_product_ids[$index]);

        

        // Insert or update product based on product_id
        if ($product_id === 'reg') {
            $check_brand_again = "SELECT * FROM brand WHERE brand_name = '$brand' LIMIT 1";
            $check_brand_again_res = $conn->query($check_brand_again);
            if ($check_brand_again_res->num_rows > 0) {
                $row = $check_brand_again_res->fetch_assoc();
                $brand_id = $row['id'];
            } else {
                    $brand_insert = "INSERT INTO brand SET brand_name = '$brand', `date` = '$currentDateTime'";
                    $conn->query($brand_insert);
                    $brand_id = $conn->insert_id;
            }

            $check_category_again = "SELECT * FROM category WHERE category_name = '$category' LIMIT 1";
            $check_category_again_res = $conn->query($check_category_again);
            if ($check_category_again_res->num_rows > 0) {
                $row = $check_category_again_res->fetch_assoc();
                $category_id = $row['id'];
            } else {
                    $category_insert = "INSERT INTO category SET category_name = '$category', `date` = '$currentDateTime'";
                    $conn->query($category_insert);
                    $category_id = $conn->insert_id;
            }

            $check_product_again = "SELECT * FROM product WHERE category = '$category_id' AND brand = '$brand_id' AND `description` = '$item' AND parent_barcode = '$barcode' LIMIT 1";
            $check_product_res = $conn->query($check_product_again);
            if ($check_product_res->num_rows > 0) {
                $row = $check_product_res->fetch_assoc();
                $product_id = $row['id'];
            } else {
                $product_query = "INSERT INTO product (`description`, brand, category, parent_barcode, product_img, `date`, user_id) 
                                  VALUES ('$item', '$brand_id', '$category_id', '$barcode', '', '$currentDateTime', '$user_id')";
                if ($conn->query($product_query) === TRUE) {
                    $product_id = $conn->insert_id;
                } else {
                    $response['errors'][] = "Error registering new product: " . $conn->error;
                    continue;
                }
            }
        }
        $check_Supplier = "SELECT * FROM supplier WHERE supplier_name = '$supplier' LIMIT 1";
        $check_Supplier_res = $conn->query($check_Supplier);
        if($check_Supplier_res->num_rows>0){
            $row = $check_Supplier_res->fetch_assoc();
            $supplier_id = $row['id'];
        } else {

            // Insert or update supplier based on supplier_id
            $locality = $supplier_id === 'reg_int' ? 'international' : 'local';
            $supplier_query = "INSERT INTO supplier (supplier_name, local_international, `date`) 
                            VALUES ('$supplier', '$locality', '$currentDateTime')";
            
            if ($conn->query($supplier_query) === TRUE) {
                $supplier_id = $conn->insert_id;
            } else {
                $response['errors'][] = "Error registering new supplier: " . $conn->error;
                continue;
            }
        }

        for($new_barcode = 0; $new_barcode <= $qty; $new_barcode++){
            // Generate unique barcode
            $unique_barcode = $barcode . "-" . $new_barcode;
            // Insert stock data
            $inserT_stocks = "INSERT INTO stocks SET unique_barcode = '$unique_barcode', product_id = '$product_id', parent_barcode = '$barcode', batch_code = '$batch', capital = '$price', warehouse = '$warehouse', supplier = '$supplier_id', `date` = '$currentDateTime', user_id = '$user_id'";
            if ($conn->query($inserT_stocks) === TRUE) {
                $stock_id = $conn->insert_id;
                include "barcode_layout.php";
            } else {
                $response['errors'][] = "Error updating row with ID $unique_id: " . $conn->error;
            }
        }


    }

    // Delete the CSV entry after processing
    $delete_csv = "DELETE FROM inbound_csv WHERE csv_id = '$csv_id'";
    if ($conn->query($delete_csv) === TRUE) {
        $response['success'][] = "Successfully wiped the CSV data.";
    } else {
        $response['errors'][] = "Error deleting CSV data: " . $conn->error;
    }

    // Close database connection
    $conn->close();

    // Return a JSON response for AJAX handling
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>
