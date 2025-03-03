<div class="table-responsive p-3">
    <table class="table table-bordered border-dark table-sm">
        <thead>
            <tr class="table-dark">
                <th  scope="col">Batch Code</th>
                <th  scope="col">Qty (Available)</th>
                <th  scope="col">Supplier</th>
                <th  scope="col">Import</th>
                <th  scope="col">Imbounded by</th>
                <th  scope="col">Inbounded date</th>
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
                        s.item_status,
                        s.price,
                        r.location_name
                    FROM stocks s
                    LEFT JOIN supplier sup ON s.supplier = sup.hashed_id
                    LEFT JOIN users u ON s.user_id = u.hashed_id
                    LEFT JOIN item_location r ON s.item_location = r.id
                    WHERE s.product_id = ? 
                      AND s.warehouse = ?
                    ORDER BY s.date
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
                                if($row['import_status'] === "Local" || $row['import_status'] === "LOCAL"){
                                    $import_status = '<span class="badge bg-primary">Local</span>';
                                } else {
                                    $import_status = '<span class="badge bg-warning">International</span>';
                                }
                                echo "
                                    <tr>
                                        <td scope='row'>
                                            <a data-bs-toggle='collapse' href='#product-details-modal" . htmlspecialchars($row['batch_code']) . '-' . $id . '-' . $warehouse . "' role='button' aria-expanded='false' aria-controls='product-details-modal" . htmlspecialchars($row['batch_code']) . '-' . $id . '-' . $warehouse . "'>
                                                " . htmlspecialchars($row['batch_code']) . "
                                            </a>
                                        </td>
                                        <td class='text-end'>" . htmlspecialchars($row['available_quantity']) . "</td>
                                        <td>" . htmlspecialchars($row['supplier_name']) . "</td>
                                        <td>" . $import_status . "</td>
                                        <td>" . htmlspecialchars($row['added_by']) . "</td>
                                        <td>" . htmlspecialchars($row['date']) . "</td>
                                    </tr>
                                    <tr class='collapse p-0 m-0' id='product-details-modal" . htmlspecialchars($row['batch_code']) . '-' . $id . '-' . $warehouse . "'>
                                        <td class='p-0 m-0' colspan='6'>
                                            <div id=\"tableExample\" data-list='{\"valueNames\":[\"barcode" . $row['batch_code'] . "\",\"status" . $row['batch_code'] . "\",\"capital" . $row['batch_code'] . "\",\"sold" . $row['batch_code'] . "\",\"location" . $row['batch_code'] . "\"],\"pagination\":false}'>
                                                <div class='table-responsive scrollbar'>
                                                        <table class='table table-hover table-striped table-bordered border-info table-sm'>
                                                            <thead class='table-info'>
                                                                <tr>
                                                                    <th class='text-900 sort' data-sort='barcode" . $row['batch_code'] . "'>Barcode</th>
                                                                    <th class='text-900 sort' data-sort='status" . $row['batch_code'] . "'>Fullfilment Status</th>
                                                                    <th class='text-900 sort' data-sort='capital" . $row['batch_code'] . "'>Capital</th>
                                                                    <th class='text-900 sort' data-sort='sold" . $row['batch_code'] . "'>Sold Amount</th>
                                                                    <th class='text-900 sort' data-sort='location" . $row['batch_code'] . "'>Item Location</th>
                                                                </tr>
                                                            </thead>
                                                        <tbody>
                                ";
                            }

                            if(empty($row['location_name'])){
                                $location_name = '<span class="badge rounded-pill badge-subtle-warning">For SKU</span>';
                            } else {
                                $location_name = '<span class="badge rounded-pill badge-subtle-primary">' . $row['location_name'] . '</span>';
                            }
                            if($row['item_status'] == 0) {
                                $item_status = '<span class="badge rounded-pill bg-success">Available</span>';
                            } elseif($row['item_status'] == 1) {
                                $item_status = '<span class="badge rounded-pill bg-danger">Sold</span>';
                            } elseif($row['item_status'] == 2) {
                                $item_status = '<span class="badge rounded-pill bg-primary">Enroute</span>';
                            } elseif($row['item_status'] == 3) {
                                $item_status = '<span class="badge rounded-pill bg-warning">For Enroute</span>';
                            } else {
                                $item_status = '<span class="badge rounded-pill bg-warning">Returned</span>';
                            }
                            // Display product details for the current batch code
                            echo "
                                <tr>
                                    <td class='barcode" . $row['batch_code'] . "'><a href='../Product-info/?prod=" . htmlspecialchars($row['unique_barcode']) . "'><small>" . htmlspecialchars($row['unique_barcode']) . "</small></a></td>
                                    <td class='status" . $row['batch_code'] . " text-center'>" . $item_status . "</td>
                                    <td class='capital" . $row['batch_code'] . " text-end'><small>" . htmlspecialchars($row['capital']) . "</small></td>
                                    <td class='sold" . $row['batch_code'] . "'><small>" . $row['price'] . "</small></td>
                                    <td class='location" . $row['batch_code'] . "'><small>" . $location_name . "</small></td>
                                </tr>
                            ";
                        }

                        // Close the last batch details table
                        echo "</tbody></table></div></div></td></tr>";
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
