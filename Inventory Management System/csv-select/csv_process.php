<?php
// Include necessary files for database connection and session handling
include 'database.php';
include 'on_session.php';

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
        if ($product_id == 'reg') {
            // Register new product in the database
            $product_query = "INSERT INTO product (description, brand, category, barcode, qty, price) 
                              VALUES ('$item', (SELECT id FROM brand WHERE name = '$brand' LIMIT 1), 
                                      (SELECT id FROM category WHERE name = '$category' LIMIT 1), 
                                      '$barcode', '$qty', '$price')";
            
            if ($conn->query($product_query) === TRUE) {
                $product_id = $conn->insert_id;
            } else {
                $response['errors'][] = "Error registering new product: " . $conn->error;
                continue;
            }
        }

        // Insert or update supplier based on supplier_id
        if ($supplier_id == 'reg') {
            // Register new supplier in the database
            $supplier_query = "INSERT INTO supplier (supplier_name, local_international) 
                               VALUES ('$supplier', 'Unknown')";
            
            if ($conn->query($supplier_query) === TRUE) {
                $supplier_id = $conn->insert_id;
            } else {
                $response['errors'][] = "Error registering new supplier: " . $conn->error;
                continue;
            }
        }

        // Insert or update the inbound CSV data
        $csv_update_query = "UPDATE inbound_csv SET 
                                product_id = '$product_id',
                                item = '$item', 
                                keyword = '$keyword', 
                                qty = '$qty', 
                                price = '$price', 
                                supplier = '$supplier', 
                                supplier_id = '$supplier_id', 
                                barcode = '$barcode', 
                                batch = '$batch', 
                                brand = '$brand', 
                                category = '$category', 
                                warehouse = '$warehouse'
                             WHERE id = '$unique_id'";

        if ($conn->query($csv_update_query) === TRUE) {
            $response['success'][] = "Row with ID $unique_id updated successfully.";
        } else {
            $response['errors'][] = "Error updating row with ID $unique_id: " . $conn->error;
        }
    }

    // Close database connection
    $conn->close();

    // Return a JSON response (for potential AJAX handling)
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>
