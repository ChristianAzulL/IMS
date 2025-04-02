<?php
include "database.php";
include "on_session.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
    // Get product details from POST request
    $product_id = $_POST['product_id'];
    $product_description = $_POST['product_description'];
    $category_id = $_POST['category'];
    $brand_id = $_POST['brand'];
    $safety =  $_POST['safety'];

    // Start a transaction to ensure all updates are consistent
    $conn->begin_transaction();

    try {
        // Fetch current product data
        $stmt = $conn->prepare("SELECT `description`, brand, category, product_img, `safety` FROM product WHERE id = ?");
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $res = $stmt->get_result();
        $product = $res->fetch_assoc();
        $stmt->close();

        // Check if description is different and needs to be updated
        if ($product['description'] !== $product_description) {
            $stmt = $conn->prepare("UPDATE product SET `description` = ? WHERE id = ?");
            $stmt->bind_param("si", $product_description, $product_id);
            $stmt->execute();
            $stmt->close();
        }

        // Check if brand is different and needs to be updated
        if ($product['brand'] !== $brand_id) {
            $stmt = $conn->prepare("UPDATE product SET brand = ? WHERE id = ?");
            $stmt->bind_param("si", $brand_id, $product_id);
            $stmt->execute();
            $stmt->close();
        }

        // Check if category is different and needs to be updated
        if ($product['category'] !== $category_id) {
            $stmt = $conn->prepare("UPDATE product SET category = ? WHERE id = ?");
            $stmt->bind_param("si", $category_id, $product_id);
            $stmt->execute();
            $stmt->close();
        }

        // Check if category is different and needs to be updated
        if ($product['safety'] !== $safety) {
            $stmt = $conn->prepare("UPDATE product SET `safety` = ? WHERE id = ?");
            $stmt->bind_param("ii", $safety, $product_id);
            $stmt->execute();
            $stmt->close();
        }

        // Check if a new image was uploaded
        if (isset($_FILES['profile-pic']) && $_FILES['profile-pic']['error'] === UPLOAD_ERR_OK) {
            // Get the uploaded file info
            $file_tmp = $_FILES['profile-pic']['tmp_name'];
            $file_name = $_FILES['profile-pic']['name'];
            $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

            // Generate a unique file name
            $unique_name = uniqid() . '.' . $file_ext;
            $upload_dir = '../../assets/img/';
            $target_path = $upload_dir . $unique_name;

            // Check if the uploaded image already exists in the directory
            if (!file_exists($target_path)) {
                // Move the uploaded file to the directory
                if (move_uploaded_file($file_tmp, $target_path)) {
                    // Check if the current product image is the same as the uploaded one
                    if ($product['product_img'] !== $unique_name) {
                        // Update the product image in the database
                        $stmt = $conn->prepare("UPDATE product SET product_img = ? WHERE id = ?");
                        $stmt->bind_param("si", $unique_name, $product_id);
                        $stmt->execute();
                        $stmt->close();
                    }
                } else {
                    throw new Exception("Failed to upload the image.");
                }
            } else {
                throw new Exception("Image with this name already exists.");
            }
        }

        // Commit the transaction
        $conn->commit();

        // Send a success JSON response
        echo json_encode([
            'status' => 'success',
            'message' => 'Product updated successfully!'
        ]);
    } catch (Exception $e) {
        // Rollback the transaction if something goes wrong
        $conn->rollback();

        // Send an error JSON response
        echo json_encode([
            'status' => 'error',
            'message' => 'Error: ' . $e->getMessage()
        ]);
    }
}
?>
