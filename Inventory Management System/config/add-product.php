<?php
// Include the database connection file
include('database.php');
include('on_session.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize the form inputs
    $productDescription = $_POST['product_description'] ?? '';
    $category = $_POST['category'] ?? '';
    $brand = $_POST['brand'] ?? '';
    $parentBarcode = $_POST['parent_barcode'] ?? '';
    $image = $_FILES['product_image'] ?? 'def_img.png';

    // Function to generate a unique 9-digit number
    function generateUniqueBarcode($conn) {
        do {
            $barcode = "LPO " . str_pad(rand(0, 9999999), 7, '0', STR_PAD_LEFT);
            $query = "SELECT COUNT(*) FROM product WHERE parent_barcode = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("s", $barcode);
            $stmt->execute();
            $stmt->bind_result($count);
            $stmt->fetch();
            $stmt->close();
        } while ($count > 0); // Keep generating if barcode exists

        return $barcode;
    }

    // Generate a new barcode if parentBarcode is empty, null, or not set
    if (empty($parentBarcode)) {
        $parentBarcode = generateUniqueBarcode($conn);
    }

    // Initialize the file path for the product image
    $imagePath = '../../assets/img/';

    // Check if an image was uploaded
    if ($image && $image['error'] === 0) {
        $imageName = basename($image['name']);
        $targetDir = "../../assets/img/"; // Ensure this directory exists and has write permissions
        $targetFilePath = $targetDir . $imageName;

        // Move the uploaded file to the target directory
        if (move_uploaded_file($image['tmp_name'], $targetFilePath)) {
            $imagePath = $targetFilePath;
        } else {
            die("Error: Could not upload image.");
        }
    } else {
        $imagePath = "def_img.png";
    }

    // Prepare the SQL statement to insert product data
    $sql = "INSERT INTO product (`description`, category, brand, parent_barcode, product_img, `date`, `user_id`) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssss", $productDescription, $category, $brand, $parentBarcode, $imagePath, $currentDateTime, $user_id);

    // Execute the query and check for success
    if ($stmt->execute()) {
        $product_id = $stmt->insert_id;
        $hashed_product_id = hash('sha256', $product_id);
        $update = "UPDATE product SET hashed_id = '$hashed_product_id' WHERE id = '$product_id'";
        if ($conn->query($update) === TRUE) {
            header("Location: ../Product-list/?success=true");
        }
    } else {
        $error_message = "Error: " . $stmt->error;
        header("Location: ../Product-list/?success=false&err=$error_message");
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
