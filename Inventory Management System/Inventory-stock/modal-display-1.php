<table>
    <thead>
        <tr>
            <th>Unique Barcode</th>
            <th>Status</th>
            <th>Capital</th>
            <th>Sold Amount</th>
            <th>Location</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Enable error reporting for debugging
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        include "../config/database.php";

        if (isset($_GET['target_id'])) {
            $batch_code = $_GET['target_id'];

            // ✅ Use Prepared Statements to Prevent SQL Injection
            $query = "SELECT 
                        s.unique_barcode, 
                        s.item_status, 
                        il.location_name, 
                        s.capital, 
                        ol.sold_price 
                      FROM stocks s 
                      LEFT JOIN item_location il ON il.id = s.item_location 
                      LEFT JOIN outbound_content ol ON ol.unique_barcode = s.unique_barcode 
                      WHERE s.batch_code = ? 
                      ORDER BY s.barcode_extension ASC LIMIT 1000";

            if ($stmt = $conn->prepare($query)) {
                $stmt->bind_param("s", $batch_code);
                $stmt->execute();
                $res = $stmt->get_result();

                // ✅ Capture Output Buffer (For Content-Length Header)
                ob_start();

                if ($res->num_rows > 0) {
                    while ($row = $res->fetch_assoc()) {
                        $location_name = !empty($row['location_name']) 
                            ? '<span class="badge rounded-pill badge-subtle-primary">' . htmlspecialchars($row['location_name']) . '</span>'
                            : '<span class="badge rounded-pill badge-subtle-warning">For SKU</span>';

                        // ✅ Improved Item Status Handling
                        $status_map = [
                            0 => 'success|Available',
                            1 => 'danger|Sold',
                            2 => 'primary|Enroute',
                            3 => 'warning|For Enroute'
                        ];
                        $status = $status_map[$row['item_status']] ?? 'warning|Returned';
                        list($status_class, $status_text) = explode('|', $status);

                        echo "
                            <tr>
                                <td class='barcode'>
                                    <a href='../Product-info/?prod=" . htmlspecialchars($row['unique_barcode']) . "'>
                                        <small>LPO " . htmlspecialchars($row['unique_barcode']) . "</small>
                                    </a>
                                </td>
                                <td class='status text-center'>
                                    <span class='badge rounded-pill bg-{$status_class}'>{$status_text}</span>
                                </td>
                                <td class='capital text-end'><small>" . htmlspecialchars($row['capital']) . "</small></td>
                                <td class='sold'><small>" . $row['sold_price'] . "</small></td>
                                <td class='location'><small>" . $location_name . "</small></td>
                            </tr>
                        ";
                    }
                }

                // ✅ Set `Content-Length` for Accurate Loading Bar Progress
                $output = ob_get_clean();
                header("Content-Length: " . strlen($output));
                echo $output;

                $stmt->close();
            } else {
                echo "<tr><td colspan='5'>Error preparing query.</td></tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No batch code provided.</td></tr>";
        }
        ?>
    </tbody>
</table>
