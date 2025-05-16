<?php
// File name
$filename = "audit_test.csv";

// Open file for writing
$file = fopen($filename, "w");

// CSV headers
$headers = ["Order Number", "Order Line ID", "Warehouse", "Client", "Fulfillment Status", "Amount Paid"];
fputcsv($file, $headers);

// Sample data options
$warehouses = ["WH-A", "WH-B", "WH-C", "WH-D"];
$clients = ["ClientX", "ClientY", "ClientZ", "ClientA"];
$statuses = ["Pending", "Shipped", "Delivered", "Cancelled", "Returned"];

// Generate 1000 rows of random data
for ($i = 0; $i < 4999; $i++) {
    $orderNumber = "ORD" . str_pad(rand(1, 999999), 6, '0', STR_PAD_LEFT);
    $orderLineId = "OL" . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);
    $warehouse = $warehouses[array_rand($warehouses)];
    $client = $clients[array_rand($clients)];
    $status = $statuses[array_rand($statuses)];
    $amountPaid = number_format(rand(1000, 50000) / 100, 2); // e.g., 10.00 - 500.00

    $row = [$orderNumber, $orderLineId, $warehouse, $client, $status, $amountPaid];
    fputcsv($file, $row);
}

// Close file
fclose($file);

echo "CSV file 'audit_test.csv' created successfully.";
?>
