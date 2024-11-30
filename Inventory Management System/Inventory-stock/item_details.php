<div class="table-responsive p-3">
    <table class="table bordered-table">
        <thead>
            <th>Batch Code</th>
            <th>Qty(Available)</th>
            <th>Supplier</th>
            <th>Import</th>
            <th>Imbounded by</th>
            <th>Date Added</th>
        </thead>
        <tbody>

        <?php
include "../config/database.php";

if (isset($_GET['id']) && isset($_GET['wh'])) {
    $id = $_GET['id'];
    $warehouse = $_GET['wh'];

    $query = "SELECT s.*, 
                 sup.local_international, 
                 sup.supplier_name, 
                 u.user_fname, 
                 u.user_lname, 
                 COUNT(CASE WHEN s.item_status = 0 THEN 1 END) AS quantity
          FROM stocks s
          LEFT JOIN supplier sup ON s.supplier = sup.hashed_id
          LEFT JOIN users u ON s.user_id = u.hashed_id
          WHERE s.product_id = ? 
          AND s.warehouse = ? 
          GROUP BY s.batch_code";

    $stmt = $conn->prepare($query);

    if ($stmt === false) {
        die('Error preparing statement: ' . $conn->error);
    }

    // Bind the parameters to the prepared statement
    $stmt->bind_param("ss", $id, $warehouse); // assuming both are strings, adjust if necessary
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if(empty($row['local_international']) || !isset($row['local_international'])){
                $import = "Not set yet";
            } else {
                $import = $row['local_international'];
            }
            ?>
            <tr>
                <td><a href="#<?php echo $row['batch_code'];?>"><?php echo $row['batch_code']; ?></a></td>
                <td><?php echo $row['quantity']; ?></td>
                <td><?php echo $row['supplier_name'];?></td>
                <td><?php echo $import;?></td>
                <td><?php echo $row['user_fname'] . " " . $row['user_lname'];?></td>
                <td><?php echo $row['date']; ?></td>
            </tr>
            <?php
        }
    } else {
        echo "No data found for the given product ID and warehouse.";
    }

    $stmt->close();
} else {
    echo "No product ID or warehouse provided.";
}
?>

</tbody>
</table>
</div>