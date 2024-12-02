<div class="table-responsive p-3">
    <table class="table table-bordered border-dark table-sm">
        <thead>
            <tr class="table-dark">
                <th  scope="col">Batch Code</th>
                <th  scope="col">Qty (Available)</th>
                <th  scope="col">Supplier</th>
                <th  scope="col">Import</th>
                <th  scope="col">Imbounded by</th>
                <th  scope="col">Date Added</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include "../config/database.php";

            // Check if both parameters are provided
            if (isset($_GET['id']) && isset($_GET['wh'])) {
                $id = $_GET['id'];
                $id = explode('-', $id)[0]; // sanitize to only the first part
                $warehouse = $_GET['wh'];

                // Use a single query to get all necessary information
                $query = "
                    SELECT 
                        s.batch_code,
                        COALESCE((
                            SELECT COUNT(*) 
                            FROM stocks 
                            WHERE item_status = 0 
                            AND batch_code = s.batch_code 
                            AND product_id = s.product_id 
                            AND warehouse = s.warehouse
                        ), 0) AS available_quantity,
                        sup.supplier_name,
                        COALESCE(sup.local_international, 'Not set yet') AS import_status,
                        CONCAT(u.user_fname, ' ', u.user_lname) AS added_by,
                        s.date,
                        s.unique_barcode, 
                        s.capital, 
                        r.location_name
                    FROM stocks s
                    LEFT JOIN supplier sup ON s.supplier = sup.hashed_id
                    LEFT JOIN users u ON s.user_id = u.hashed_id
                    LEFT JOIN item_location r ON s.item_location = r.id
                    WHERE s.product_id = ? 
                      AND s.warehouse = ?
                    ORDER BY s.batch_code, s.unique_barcode
                ";

                if ($stmt = $conn->prepare($query)) {
                    $stmt->bind_param("ss", $id, $warehouse);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    $previous_batch_code = '';

                    if ($result->num_rows > 0) {
                        // Fetch and display each row
                        while ($row = $result->fetch_assoc()) {
                            // Check if we are still in the same batch code
                            if ($previous_batch_code != $row['batch_code']) {
                                
                                // Start a new batch code row
                                if ($previous_batch_code != '') {
                                    echo "</tbody></table></td></tr>"; // Close previous batch details table
                                }

                                $previous_batch_code = $row['batch_code'];
                                echo "
                                    <tr>
                                        <td scope='row'>
                                            <a data-bs-toggle='collapse' href='#product-details-modal" . htmlspecialchars($row['batch_code']) . '-' . $id . '-' . $warehouse . "' role='button' aria-expanded='false' aria-controls='product-details-modal" . htmlspecialchars($row['batch_code']) . '-' . $id . '-' . $warehouse . "'>
                                                " . htmlspecialchars($row['batch_code']) . "
                                            </a>
                                        </td>
                                        <td class='text-end'>" . htmlspecialchars($row['available_quantity']) . "</td>
                                        <td>" . htmlspecialchars($row['supplier_name']) . "</td>
                                        <td>" . htmlspecialchars($row['import_status']) . "</td>
                                        <td>" . htmlspecialchars($row['added_by']) . "</td>
                                        <td>" . htmlspecialchars($row['date']) . "</td>
                                    </tr>
                                    <tr class='collapse p-0 m-0' id='product-details-modal" . htmlspecialchars($row['batch_code']) . '-' . $id . '-' . $warehouse . "'>
                                        <td class='p-0 m-0' colspan='6'>
                                            <table class='table table-hover table-striped table-bordered border-info table-sm'>
                                                <thead class='table-info'>
                                                    <tr>
                                                        <th scope='row'>Barcode</th>
                                                        <th>Capital</th>
                                                        <th>Item Location</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                ";
                            }

                            // Display product details for the current batch code
                            echo "
                                <tr>
                                    <td><small>" . htmlspecialchars($row['unique_barcode']) . "</small></td>
                                    <td class='text-end'><small>" . htmlspecialchars($row['capital']) . "</small></td>
                                    <td><small>" . htmlspecialchars($row['location_name']) . "</small></td>
                                </tr>
                            ";
                        }

                        // Close the last batch details table
                        echo "</tbody></table></td></tr>";
                    } else {
                        echo "<tr><td colspan='6'>No data found for the given product ID and warehouse.</td></tr>";
                    }

                    $stmt->close();
                } else {
                    // Error preparing statement
                    echo "<tr><td colspan='6'>Error: Unable to execute the query.</td></tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No product ID or warehouse provided.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>
