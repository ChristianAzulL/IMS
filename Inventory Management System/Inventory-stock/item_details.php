<div class="table-responsive p-3">
    <table class="table bordered-table">
        <thead>
            <th>Batch Code</th>
            <th>Import</th>
            <th>Date Added</th>
        </thead>
        <tbody>

<?php
include "../config/database.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $wh = $_GET['wh'];
    
    $query = "SELECT s.*, sup.local_international
              FROM stocks s
              LEFT JOIN supplier sup ON s.supplier = sup.hashed_id 
              WHERE s.product_id = ?" . (!empty($wh) ? " AND s.warehouse = ?" : "") . 
              " GROUP BY s.batch_code";

    // Prepare the statement
    $stmt = $conn->prepare($query);

    if ($stmt === false) {
        die('Error preparing statement: ' . $conn->error);
    }

    // Bind parameters
    if (!empty($wh)) {
        $stmt->bind_param("ss", $id, $wh); // Bind both product_id and warehouse
    } else {
        $stmt->bind_param("s", $id); // Only bind product_id
    }

    $stmt->execute();
    $result = $stmt->get_result();
    if(empty($wh)){
        $sample = "All Warehouse";
    } else {
        $sample = $wh;
    }

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                <td>{$row['batch_code']}</td>
                <td><small>{$sample}</small></td>
                <td>{$row['date']}</td>
                </tr>";
        }
    } else {
        echo "No data found for the given product ID.";
    }

    $stmt->close();
} else {
    echo "No product ID provided.";
}
?>
</tbody>
</table>
</div>