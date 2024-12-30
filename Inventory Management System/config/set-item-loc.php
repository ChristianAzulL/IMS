<?php
include "database.php";
include "on_session.php";

if (!isset($_SESSION['unique_key'])) {
    // Redirect to login or handle error as per your application flow
    die("Unauthorized access.");
}

$uniqueKey = $_SESSION['unique_key'];

// Unset the specific session variable if exists
if (isset($_SESSION['last_ext'])) {
    unset($_SESSION['last_ext']);
}

// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize user inputs
    $parent_barcodes = array_map('trim', $_POST['parent_barcode']);
    $item_locations = array_map('trim', $_POST['item_location']);
    $item_loc_qtys = array_map('trim', $_POST['item_loc_qty']);

    // Loop through the barcodes, locations, and quantities
    foreach ($parent_barcodes as $index => $barcode) {
        $location = htmlspecialchars($item_locations[$index]);
        $qty = intval($item_loc_qtys[$index]); // Ensure it's an integer

        // Flag to handle barcode extension logic
        $first = true;

        echo htmlspecialchars($barcode) . "<br>"; // Output sanitized barcode

        // Use prepared statements to prevent SQL injection
        $sql = "SELECT id, barcode_extension FROM stocks WHERE parent_barcode = ? AND item_location = '' AND unique_key = ? ORDER BY barcode_extension ASC";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $barcode, $uniqueKey); // Bind parameters securely
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Loop through the result set
            while ($row = $result->fetch_assoc()) {
                $barcode_extension = $row['barcode_extension'];
                $stock_id = $row['id'];

                // Update session value for last extension
                if ($first) {
                    $last_ext = $barcode_extension + $qty;
                    $_SESSION['last_ext'] = $last_ext;
                    $first = false;
                } else {
                    $last_ext = $_SESSION['last_ext'];
                }

                echo $last_ext . "<br>"; // Output sanitized extension value

                // Check if barcode extension is less than last extension
                if ($barcode_extension < $last_ext) {
                    // Use prepared statement to update the location
                    $query = "UPDATE stocks SET item_location = ? WHERE id = ?";
                    $updateStmt = $conn->prepare($query);
                    $updateStmt->bind_param("si", $location, $stock_id); // Bind parameters securely
                    $updateStmt->execute();

                    echo "Unique barcode = " . htmlspecialchars($barcode) . "-" . htmlspecialchars($barcode_extension) . " successfully updated<br>";
                } else {
                    $first = true;
                    // Unset the specific session variable
                    unset($_SESSION['last_ext']);
                    break;
                }
            }
        }

        // Close the prepared statements
        $stmt->close();
        header("Location: ../Inventory-stock/");
    }
}
?>
