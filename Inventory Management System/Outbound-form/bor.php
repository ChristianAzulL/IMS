<?php
if (isset($_GET['view'])) {
    // Path to the JSON file
    $jsonFilePath = 'products.json';

    // Check if the file exists
    if (file_exists($jsonFilePath)) {
        // Get the content of the file
        $jsonData = file_get_contents($jsonFilePath);

        // Decode the JSON data into a PHP array
        $products = json_decode($jsonData, true);

        // Check for JSON decoding errors
        if (json_last_error() === JSON_ERROR_NONE) {
            // Check if the products array is empty
            if (!empty($products)) {
                // Iterate through each product and display its details
                foreach ($products as $product) {
                    ?>
                    <tr>
                        <td><?php echo $product['barcode']; ?></td>
                        <td><?php echo $product['product_description'];?></td>
                        <td><?php echo $product['capital'];?></td>
                        <td><input type="number" name="selling[]" min="<?php echo $product['capital'];?>" class="form-control" step="0.01" required></td>
                        <td><?php echo $product['batch_num']; ?></td>
                        <td><?php echo $product['brand_name'];?></td>
                        <td><?php echo $product['brand_name'];?></td>
                        <td><?php echo $product['category_name'];?></td>
                    </tr>
                    <?php
                }
            } else {
                echo "Nothing yet";
            }
        } else {
            echo "Error decoding JSON: " . json_last_error_msg();
        }
    } else {
        echo "Nothing yet";
    }
}
?>
