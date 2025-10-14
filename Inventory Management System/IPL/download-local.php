<?php 
require_once "../config/database.php";
require_once "../config/on_session.php";

// Set headers so browser downloads file as CSV
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=Inventory Per Location.csv');

// Open output stream
$output = fopen('php://output', 'w');

// Write the column headers
fputcsv($output, ['#', 'LOCATION', 'TOTAL QTY', 'TOTAL AMOUNT']);

$query = "SELECT 
            w.warehouse_name, 
            COUNT(s.unique_barcode) AS available_qty, 
            SUM(s.capital) AS total_amount 
        FROM warehouse w 
        LEFT JOIN stocks s ON s.warehouse = w.hashed_id 
        WHERE item_status = 0
        GROUP BY w.hashed_id, w.warehouse_name
        ORDER BY w.warehouse_name";

$result = $conn->query($query);
$counter = 1;

if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        // if ($counter > 2) break; // ✅ stop after 3 rows

        $warehouse_name = $row['warehouse_name'];
        $available_qty = $row['available_qty'];
        $total_amount = number_format($row['total_amount'], 2);

        // Write row to CSV
        fputcsv($output, [$counter, $warehouse_name, $available_qty, $total_amount]);
        $counter++;
    }
}

fclose($output);
exit;



// require_once "../config/database.php";
// require_once "../config/on_session.php";

// // Set headers so browser downloads file as CSV
// header('Content-Type: text/csv; charset=utf-8');
// header('Content-Disposition: attachment; filename=Inventory Per Supplier - Locals.csv');

// // Open output stream
// $output = fopen('php://output', 'w');

// // Write the column headers
// fputcsv($output, ['#', 'LOCALS', 'TOTAL QTY', 'TOTAL AMOUNT']);

// $query = "SELECT 
//             c.category_name, 
//             COUNT(s.unique_barcode) AS available_qty, 
//             SUM(s.capital) as total_amount 
//         FROM category c 
//         LEFT JOIN product p ON p.category = c.hashed_id 
//         LEFT JOIN stocks s ON s.product_id = p.hashed_id 
//         LEFT JOIN supplier sup ON sup.hashed_id = s.supplier
//         WHERE item_status = 0
//         AND sup.local_international = 'Local'
//         GROUP BY p.category
//         ORDER BY c.category_name";

// $result = $conn->query($query);
// $counter = 1;

// if($result->num_rows > 0){
//     while($row = $result->fetch_assoc()){
//         $category = $row['category_name'];
//         $available_qty = $row['available_qty'];
//         $total_amount = number_format($row['total_amount'], 2);

//         // Write row to CSV
//         fputcsv($output, [$counter, $category, $available_qty, $total_amount]);
//         $counter++;
//     }
// }

// fclose($output);
// exit;
