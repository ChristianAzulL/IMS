<?php
include "Inventory Management System/config/database.php";

// Create a new ZipArchive in memory
$zip = new ZipArchive();
$zipFilename = 'outbound_logs_duplicates_by_user.zip';

// Use a temporary file for the zip archive
$tmpFile = tempnam(sys_get_temp_dir(), 'zip');

if ($zip->open($tmpFile, ZipArchive::CREATE) !== TRUE) {
    die("Could not open temporary file for ZIP archive.");
}

// Get all users who have outbound logs with duplicate hashed_id
$userSql = "
    SELECT DISTINCT u.hashed_id, u.user_fname, u.user_lname
    FROM users u
    JOIN outbound_logs ol ON ol.user_id = u.hashed_id
    JOIN (
        SELECT hashed_id
        FROM outbound_logs
        GROUP BY hashed_id
        HAVING COUNT(*) > 1
    ) dup ON ol.hashed_id = dup.hashed_id
";

$userResult = $conn->query($userSql);

if (!$userResult || $userResult->num_rows == 0) {
    die("No users with outbound logs having duplicate hashed_id found.");
}

// Prepare statement to get duplicated outbound logs per user
$logStmt = $conn->prepare("
    SELECT 
        ol.*, 
        w.warehouse_name, 
        c.courier_name,
        lp.logistic_name
    FROM outbound_logs ol
    JOIN (
        SELECT hashed_id
        FROM outbound_logs
        GROUP BY hashed_id
        HAVING COUNT(*) > 1
    ) dup ON ol.hashed_id = dup.hashed_id
    LEFT JOIN warehouse w ON ol.warehouse = w.hashed_id
    LEFT JOIN courier c ON c.hashed_id = ol.courier
    LEFT JOIN logistic_partner lp ON lp.hashed_id = ol.platform
    WHERE ol.user_id = ?
    ORDER BY ol.hashed_id
");

// Prepare statement to get outbound contents per outbound log
$contentStmt = $conn->prepare("
    SELECT 
        oc.unique_barcode, 
        p.description, 
        c.category_name, 
        b.brand_name, 
        oc.sold_price 
    FROM outbound_content oc 
    LEFT JOIN stocks s ON s.unique_barcode = oc.unique_barcode 
    LEFT JOIN product p ON p.hashed_id = s.product_id 
    LEFT JOIN brand b ON b.hashed_id = p.brand 
    LEFT JOIN category c ON c.hashed_id = p.category 
    WHERE oc.hashed_id = ?
");

while ($user = $userResult->fetch_assoc()) {
    $userId = $user['hashed_id'];
    $fileName = $user['user_fname'] . $user['user_lname'] . '.csv';

    // Open memory stream for CSV content
    $csvMemory = fopen('php://temp', 'r+');

    // Get duplicated outbound logs for this user
    $logStmt->bind_param("s", $userId);
    $logStmt->execute();
    $logRes = $logStmt->get_result();

    if ($logRes && $logRes->num_rows > 0) {
        while ($log = $logRes->fetch_assoc()) {
            // Write outbound log header before each outbound log block
            fputcsv($csvMemory, [
                'Outbound ID', 'Warehouse', 'ID', 'Hashed ID', 'Customer', 'Order #', 'Order Line ID',
                'Platform', 'Courier'
            ]);
            
            // Write outbound log details
            fputcsv($csvMemory, [
                $log["hashed_id"],
                $log['warehouse_name'],
                $log["id"],
                $log["hashed_id"],
                $log["customer_fullname"],
                $log["order_num"],
                $log["order_line_id"],
                $log["logistic_name"],
                $log["courier_name"]
            ]);

            // Write outbound content header before each block of items
            fputcsv($csvMemory, ['Barcode', 'Product', 'Category', 'Brand', 'Sold Price']);

            // Get outbound contents for this outbound_log
            $contentStmt->bind_param("s", $log["hashed_id"]);
            $contentStmt->execute();
            $contentRes = $contentStmt->get_result();

            if ($contentRes && $contentRes->num_rows > 0) {
                while ($item = $contentRes->fetch_assoc()) {
                    fputcsv($csvMemory, [
                        $item['unique_barcode'],
                        $item['description'],
                        $item['category_name'],
                        $item['brand_name'],
                        $item['sold_price']
                    ]);
                }
            } else {
                fputcsv($csvMemory, ['No items found', '', '', '', '']);
            }

            // Blank line to separate logs
            fputcsv($csvMemory, []);
        }
    } else {
        fputcsv($csvMemory, ['No duplicated outbound logs found for this user']);
    }

    // Rewind the memory stream and read its contents
    rewind($csvMemory);
    $csvContent = stream_get_contents($csvMemory);
    fclose($csvMemory);

    // Add the CSV content as a file to the ZIP archive
    $zip->addFromString($fileName, $csvContent);
}

$logStmt->close();
$contentStmt->close();
$conn->close();

$zip->close();

// Send ZIP file to browser for download
header('Content-Type: application/zip');
header('Content-Disposition: attachment; filename="' . $zipFilename . '"');
header('Content-Length: ' . filesize($tmpFile));

readfile($tmpFile);

// Delete temporary zip file after download
unlink($tmpFile);
exit;
?>
