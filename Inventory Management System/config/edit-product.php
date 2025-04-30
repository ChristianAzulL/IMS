<?php
include "database.php";
include "on_session.php";
// header('Content-Type: application/json'); // Optional but helps

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
    $product_description = $_POST['product_description'];
    $category_id = $_POST['category'];
    $brand_id = $_POST['brand'];
    $safety =  $_POST['safety'];
    $for_warehouse = $_POST['safety_for'];
    $title = 'UPDATED PRODUCT';
    
    // Get parent_barcode using hashed_id
    $stmt = $conn->prepare("SELECT parent_barcode FROM product WHERE id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    $stmt->close();

    $parent_barcode = $data ? $data['parent_barcode'] : null;

    $conn->begin_transaction();

    try {
        $stmt = $conn->prepare("SELECT p.description, p.brand, p.category, p.product_img, s.safety FROM product p LEFT JOIN stocks s ON s.product_id = p.hashed_id WHERE p.id = ?");
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        $res = $stmt->get_result();
        $product = $res->fetch_assoc();
        $stmt->close();

        if ($product['description'] !== $product_description) {
            $stmt = $conn->prepare("UPDATE product SET `description` = ? WHERE id = ?");
            $stmt->bind_param("si", $product_description, $product_id);
            $stmt->execute();
            $stmt->close();

            // Log the action
            $log = $conn->prepare("INSERT INTO logs (title, action, date, user_id) VALUES (?, ?, ?, ?)");
            $desc = "Updated description of product to " . $product_description .".";
            $log->bind_param("ssss", $title, $desc, $currentDateTime, $user_id);
            $log->execute();
            $log->close();
        }

        if ($product['brand'] !== $brand_id) {
            $stmt = $conn->prepare("UPDATE product SET brand = ? WHERE id = ?");
            $stmt->bind_param("si", $brand_id, $product_id);
            $stmt->execute();
            $stmt->close();

            // Log the action
            $log = $conn->prepare("INSERT INTO logs (title, action, date, user_id) VALUES (?, ?, ?, ?)");
            $desc = "Updated brand of product ID $product_id from '{$product['brand']}' to '$brand_id'";
            $log->bind_param("ssss", $title, $desc, $currentDateTime, $user_id);
            $log->execute();
            $log->close();
        }

        if ($product['category'] !== $category_id) {
            $stmt = $conn->prepare("UPDATE product SET category = ? WHERE id = ?");
            $stmt->bind_param("si", $category_id, $product_id);
            $stmt->execute();
            $stmt->close();

            // Log the action
            $log = $conn->prepare("INSERT INTO logs (title, action, date, user_id) VALUES (?, ?, ?, ?)");
            $desc = "Updated category of product ID $product_id from '{$product['category']}' to '$category_id'";
            $log->bind_param("ssss", $title, $desc, $currentDateTime, $user_id);
            $log->execute();
            $log->close();
        }

        if ($product['safety'] !== $safety) {
            $stmt = $conn->prepare("UPDATE stocks SET `safety` = ? WHERE warehouse = ? AND parent_barcode = ?");
            $stmt->bind_param("iss", $safety, $for_warehouse, $parent_barcode);
            $stmt->execute();
            $stmt->close();
        
            // Fetch warehouse name for better logging
            $stmt = $conn->prepare("SELECT warehouse_name FROM warehouse WHERE hashed_id = ?");
            $stmt->bind_param("s", $for_warehouse);
            $stmt->execute();
            $result = $stmt->get_result();
            $warehouse = $result->fetch_assoc();
            $stmt->close();
        
            $warehouse_name = $warehouse ? $warehouse['warehouse_name'] : 'Unknown';
        
            // Log the action
            $log = $conn->prepare("INSERT INTO logs (title, action, date, user_id) VALUES (?, ?, ?, ?)");
            $desc = "Updated safety stock for warehouse '$warehouse_name' to '$safety'";
            $log->bind_param("ssss", $title, $desc, $currentDateTime, $user_id);
            $log->execute();
            $log->close();
        }

        if (isset($_FILES['profile-pic']) && $_FILES['profile-pic']['error'] === UPLOAD_ERR_OK) {
            $file_tmp = $_FILES['profile-pic']['tmp_name'];
            $file_name = $_FILES['profile-pic']['name'];
            $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
            $unique_name = uniqid() . '.' . $file_ext;
            $upload_dir = '../../assets/img/';
            $target_path = $upload_dir . $unique_name;

            if (!file_exists($target_path)) {
                if (move_uploaded_file($file_tmp, $target_path)) {
                    if ($product['product_img'] !== $unique_name) {
                        $stmt = $conn->prepare("UPDATE product SET product_img = ? WHERE hashed_id = ?");
                        $stmt->bind_param("ss", $unique_name, $product_id);
                        $stmt->execute();
                        $stmt->close();

                        // Log the action
                        $log = $conn->prepare("INSERT INTO logs (title, action, date, user_id) VALUES (?, ?, ?, ?)");
                        $desc = "Updated image of product ID $product_id from '{$product['product_img']}' to '$unique_name'";
                        $log->bind_param("ssss", $title, $desc, $currentDateTime, $user_id);
                        $log->execute();
                        $log->close();
                    }
                } else {
                    throw new Exception("Failed to upload the image.");
                }
            } else {
                throw new Exception("Image with this name already exists.");
            }
        }

        $conn->commit();
        echo json_encode([
            'status' => 'success',
            'message' => 'Product updated successfully!'
        ]);
    } catch (Exception $e) {
        $conn->rollback();
        echo json_encode([
            'status' => 'error',
            'message' => 'Error: ' . $e->getMessage()
        ]);
    }
}
?>
