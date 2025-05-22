<?php
include "Inventory Management System/config/database.php";

// Set headers for CSV download
header('Content-Type: text/csv');
header('Content-Disposition: attachment;filename="duplicated_outbound_logs.csv"');

$output = fopen('php://output', 'w');

// Header for outbound log section
$logHeader = [
    'Outbound ID', 'Warehouse', 'ID', 'Customer', 'Order #', 'Order Line ID',
    'Platform', 'Courier', 'User', 'Date Sent'
];

// Header for barcode/content section
$contentHeader = ['Barcode', 'Product', 'Category', 'Brand', 'Sold Price'];

// Query duplicated outbound logs
$sql = "
    SELECT 
        ol.*, 
        w.warehouse_name, 
        u.user_fname, 
        u.user_lname,
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
    LEFT JOIN users u ON ol.user_id = u.hashed_id
    LEFT JOIN courier c ON c.hashed_id = ol.courier
    LEFT JOIN logistic_partner lp ON lp.hashed_id = ol.platform
    ORDER BY ol.hashed_id ASC
";

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

$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Outbound Log Section
        fputcsv($output, ['Outbound Log: ' . $row["hashed_id"]]);
        fputcsv($output, $logHeader);
        fputcsv($output, [
            $row["hashed_id"],
            $row["warehouse_name"],
            $row["id"],
            $row["customer_fullname"],
            $row["order_num"],
            $row["order_line_id"],
            $row["logistic_name"],
            $row["courier_name"],
            $row["user_fname"] . " " . $row["user_lname"],
            $row["date_sent"]
        ]);

        // Outbound Content Section
        fputcsv($output, ['Barcodes:']);
        fputcsv($output, $contentHeader);

        $contentStmt->bind_param("s", $row["hashed_id"]);
        $contentStmt->execute();
        $contentRes = $contentStmt->get_result();

        if ($contentRes && $contentRes->num_rows > 0) {
            while ($item = $contentRes->fetch_assoc()) {
                fputcsv($output, [
                    $item['unique_barcode'],
                    $item['description'],
                    $item['category_name'],
                    $item['brand_name'],
                    $item['sold_price']
                ]);
            }
        } else {
            fputcsv($output, ['No items found.']);
        }

        // Blank line between sections
        fputcsv($output, []);
    }
} else {
    fputcsv($output, ['No duplicated outbound logs found.']);
}

$contentStmt->close();
$conn->close();
fclose($output);
exit;
?>
