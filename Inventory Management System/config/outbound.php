<?php
// Include database connection (replace with your actual connection details)
include('database.php'); // Make sure to include your database connection file

// Initialize response array
$response = [
    'status' => 'error',
    'error' => 'Something went wrong.',
];

// Check if form was submitted via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Retrieve form data from the $_POST array
    $customerName = isset($_POST['customer_name']) ? $_POST['customer_name'] : '';
    $platform = isset($_POST['platform']) ? $_POST['platform'] : '';
    $courier = isset($_POST['courier']) ? $_POST['courier'] : '';
    $orderNo = isset($_POST['order_no']) ? $_POST['order_no'] : '';
    $orderLineID = isset($_POST['order_line_id']) ? $_POST['order_line_id'] : '';
    $processedBy = isset($_POST['processed_by']) ? $_POST['processed_by'] : '';

    // Retrieve the selling prices and barcodes
    $barcodes = isset($_POST['barcode']) ? $_POST['barcode'] : [];
    $sellingPrices = isset($_POST['selling']) ? $_POST['selling'] : [];

    // Basic validation (checking required fields)
    if (empty($customerName) || empty($platform) || empty($courier) || empty($orderNo) || empty($orderLineID)) {
        $response['error'] = 'All fields are required.';
        echo json_encode($response);
        exit;
    }

    // Ensure barcodes and selling prices match in count
    if (empty($barcodes) || empty($sellingPrices) || count($barcodes) !== count($sellingPrices)) {
        $response['error'] = 'Barcodes and selling prices must be provided and match in number.';
        echo json_encode($response);
        exit;
    }

    // Start a database transaction to ensure data consistency
    $conn->begin_transaction();

    try {
        // Insert order details into the orders table
        $orderSql = "INSERT INTO orders (customer_name, platform_id, courier_id, order_no, order_line_id, processed_by, created_at) 
                     VALUES ('$customerName', '$platform', '$courier', '$orderNo', '$orderLineID', '$processedBy', NOW())";
        if ($conn->query($orderSql) === TRUE) {
            // Get the last inserted order ID
            $orderID = $conn->insert_id;

            // Insert barcodes and selling prices into the order_items table
            foreach ($barcodes as $key => $barcode) {
                $sellingPrice = $sellingPrices[$key];
                $itemSql = "INSERT INTO order_items (order_id, barcode, selling_price, created_at) 
                            VALUES ('$orderID', '$barcode', '$sellingPrice', NOW())";
                if (!$conn->query($itemSql)) {
                    throw new Exception("Failed to insert order item: " . $conn->error);
                }
            }

            // Commit the transaction if everything is successful
            $conn->commit();

            // Success response
            $response['status'] = 'success';
            $response['message'] = 'Order saved successfully.';
        } else {
            throw new Exception("Failed to insert order: " . $conn->error);
        }
    } catch (Exception $e) {
        // Rollback transaction in case of an error
        $conn->rollback();
        $response['error'] = 'Transaction failed: ' . $e->getMessage();
    }
} else {
    $response['error'] = 'Invalid request method.';
}

// Send JSON response back to the front end
echo json_encode($response);
?>
