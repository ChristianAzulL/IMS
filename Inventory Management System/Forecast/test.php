<?php
require '../config/database.php'; // Use your own DB config

if (isset($_POST['upload_csv']) && isset($_FILES['csv_file'])) {
    $file = $_FILES['csv_file']['tmp_name'];
    if (mime_content_type($file) !== 'text/plain' && mime_content_type($file) !== 'text/csv') {
        die("Only CSV files are allowed.");
    }

    // Get lead times in advance
    function getAverageLeadTime($conn, $origin) {
        $stmt = $conn->prepare("
            SELECT IFNULL(AVG(TIMESTAMPDIFF(DAY, po.date_order, po.date_received)), 0) AS avg_days
            FROM purchased_order po
            JOIN supplier s ON s.hashed_id = po.supplier
            WHERE s.local_international = ? AND po.date_received IS NOT NULL
        ");
        $stmt->bind_param("s", $origin);
        $stmt->execute();
        $result = $stmt->get_result();
        $avg = $result->fetch_assoc();
        return round($avg['avg_days']);
    }

    $local_lead_time = getAverageLeadTime($conn, 'Local');
    $import_lead_time = getAverageLeadTime($conn, 'Import');

    $forecast_data = [];
    $current_category = null;

    if (($handle = fopen($file, 'r')) !== false) {
        while (($row = fgetcsv($handle)) !== false) {
            if (empty(array_filter($row))) continue;

            if (!empty($row[0]) && empty($row[1])) {
                $current_category = trim($row[0]);
                continue;
            }

            if ($current_category && !empty($row[0])) {
                $description = trim($row[0]);
                $monthly_values = array_map('floatval', array_slice($row, 1));
                $total_forecast = array_sum($monthly_values);

                $stmt = $conn->prepare("
                    SELECT 
                        p.parent_barcode,
                        COALESCE(MAX(s.safety), 0) AS safety_stock,
                        COALESCE(s2.local_international, 'Local') AS supplier_origin
                    FROM product p
                    LEFT JOIN category c ON c.hashed_id = p.category
                    LEFT JOIN stocks s ON s.product_id = p.hashed_id
                    LEFT JOIN purchased_order_content poc ON poc.product_id = p.hashed_id
                    LEFT JOIN purchased_order po ON po.id = poc.po_id
                    LEFT JOIN supplier s2 ON s2.hashed_id = po.supplier
                    WHERE p.description = ? AND c.category_name = ?
                    GROUP BY p.hashed_id
                    LIMIT 1
                ");
                $stmt->bind_param("ss", $description, $current_category);
                $stmt->execute();
                $res = $stmt->get_result();

                $parent_barcode = "Not Found";
                $safety_stock = 0;
                $local_lt = $local_lead_time;
                $import_lt = $import_lead_time;

                if ($res->num_rows > 0) {
                    $match = $res->fetch_assoc();
                    $parent_barcode = $match['parent_barcode'];
                    $safety_stock = $match['safety_stock'];

                    $origin = $match['supplier_origin'];
                    $local_lt = $origin === 'Local' ? $local_lead_time : 0;
                    $import_lt = $origin === 'Import' ? $import_lead_time : 0;
                }

                $forecast_data[] = [
                    'Category' => $current_category,
                    'Description' => $description,
                    'Parent Barcode' => $parent_barcode,
                    'Forecast Qty' => $total_forecast,
                    'Local Lead Time' => $local_lt,
                    'Import Lead Time' => $import_lt,
                    'Safety Stock' => $safety_stock
                ];
            }
        }
        fclose($handle);
    }

    // CSV Export
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment;filename=forecast_results.csv');

    $out = fopen('php://output', 'w');
    fputcsv($out, ['Category', 'Description', 'Parent Barcode', 'Forecast Qty', 'Local Lead Time', 'Import Lead Time', 'Safety Stock']);
    foreach ($forecast_data as $row) {
        fputcsv($out, $row);
    }
    fclose($out);
    exit;
}
?>

<!-- Upload Form -->
<form method="POST" enctype="multipart/form-data">
    <label for="csv_file">Upload Forecast CSV:</label>
    <input type="file" name="csv_file" accept=".csv" required>
    <button type="submit" name="upload_csv">Upload & Process</button>
</form>
