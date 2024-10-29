<?php
include "database.php";
include "on_session.php";

$selected_warehouse = $_SESSION['selected_warehouse_id'];
$po_logs = "SELECT po.*, u.user_fname, u.user_lname, s.supplier_name
            FROM purchased_order po
            LEFT JOIN users u ON u.id = po.user_id
            LEFT JOIN supplier s ON s.id = po.supplier
            WHERE po.warehouse = '$selected_warehouse' AND po.user_id = '$user_id'
            ORDER BY po.id DESC LIMIT 1";

$result = mysqli_query($conn, $po_logs);
$row = $result->fetch_assoc();

if ($row) {  // Check if the query returned any rows
    $po_id = $row['id'];
    $po_supplier = $row['supplier_name'];

    $data = '
    <!DOCTYPE html>
    <html data-bs-theme="light" lang="en-US" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    </head>
    <body>
       <h1 class="text-success">PO-' . $po_id . '</h1>
       <div class="row">
        <div class="col-lg-4 col-md-4 col-xl-4 col-sm-4 bg-primary">6</div>
        <div class="col-lg-4 col-md-4 col-xl-4 col-sm-4 bg-secondary">5</div>
        <div class="col-lg-4 col-md-4 col-xl-4 col-sm-4 bg-warning">4</div>
        <div class="col-lg-4 col-md-4 col-xl-4 col-sm-4 bg-danger">3</div>
        <div class="col-lg-4 col-md-4 col-xl-4 col-sm-4 bg-dark">2</div>
        <div class="col-lg-4 col-md-4 col-xl-4 col-sm-4 bg-primary">1</div>
       </div>
    </body>
    </html>
    ';

    $pdfname = "#po-" . $po_id . " - " . $po_supplier . ".pdf";

    include "generate-pdf.php";
} else {
    echo "No purchase order found.";
}

$conn->close();