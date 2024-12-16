<?php
if (isset($_SESSION['unique_key'])) {
    $unique_key = $_SESSION['unique_key'];

    $query = "
        SELECT 
            s.capital, 
            p.safety, 
            s.batch_code, 
            s.parent_barcode, 
            (
                SELECT COUNT(*) 
                FROM stocks 
                WHERE batch_code = s.batch_code 
                  AND product_id = s.product_id 
                  AND parent_barcode = s.parent_barcode 
                  AND warehouse = s.warehouse 
                  AND unique_key = '$unique_key'
            ) AS quantity, 
            sup.supplier_name,
            p.product_img, 
            p.keyword, 
            p.description, 
            b.brand_name, 
            c.category_name
        FROM stocks s
        LEFT JOIN product p ON s.product_id = p.hashed_id
        LEFT JOIN brand b ON p.brand = b.hashed_id
        LEFT JOIN category c ON p.category = c.hashed_id
        LEFT JOIN supplier sup ON s.supplier = sup.hashed_id
        WHERE s.unique_key = '$unique_key'
        GROUP BY s.batch_code, s.parent_barcode, s.product_id
        ORDER BY s.id ASC
    ";

    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
?>
<tr>
    <td>
        <img src="<?php echo $row['product_img'];?>" class="img-fluid" alt="">
    </td>
    <td>
        <?php echo $row['description']; ?>
    </td>
    <td>
        <?php echo $row['keyword']; ?>
    </td>
    <td>
        <?php echo $row['quantity']; ?>
    </td>
    <td>
        <?php echo $row['capital']; ?>
    </td>
    <td>
        <?php echo $row['supplier_name']; ?>
    </td>
    <td>
        <?php echo $row['parent_barcode']; ?>
    </td>
    <td>
        <?php echo $row['batch_code']; ?>
    </td>
    <td>
        <?php echo $row['brand_name']; ?>
    </td>
    <td>
        <?php echo $row['category_name']; ?>
    </td>
    
    <td>
        <?php echo $row['safety']; ?>
    </td>
    <td>
        <input type="text" name="parent_barcode[]" value="<?php echo $row['parent_barcode']?>" hidden>
        <select name="item_location[]" class="form-select" id="" required>
            <option value="">Select Item Location</option>
            <?php 
            $item_loc_query = "SELECT * FROM item_location WHERE warehouse = '$selected_warehouse_SIL' ORDER BY location_name";
            $loc_result = $conn->query($item_loc_query);
            if ($loc_result->num_rows > 0) {
                while ($loc_row = $loc_result->fetch_assoc()) {
                    echo '<option value="' . $loc_row['id'] . '">' . $loc_row['location_name'] . '</option>';
                }
            } else {
                echo '<option value="">No data</option>';
            }
            ?>
        </select>
    </td>
    <td>
        <input type="number" name="item_loc_qty[]" class="form-control" min="0" max="<?php echo $row['quantity']; ?>" placeholder="left behind will be 'For SKU'" required>
    </td>
</tr>
<?php
        }
    } else {
        echo "<tr><td colspan='12'>No records found</td></tr>";
    }
}
?>
