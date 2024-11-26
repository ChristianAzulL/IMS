<?php
include "database.php";
include "on_session.php";

$po_id = $_POST['poid'];
$selected_warehouse = $_SESSION['selected_warehouse_id'];
$user_id = $_SESSION['user_id'];  // Ensure this is defined

$po_logs = "SELECT po.*, u.user_fname, u.user_lname, s.supplier_name
            FROM purchased_order po
            LEFT JOIN users u ON u.id = po.user_id
            LEFT JOIN supplier s ON s.id = po.supplier
            WHERE po.id = '$po_id' AND po.warehouse = '$selected_warehouse' AND po.user_id = '$user_id'
            ORDER BY po.id DESC LIMIT 1";

$result = mysqli_query($conn, $po_logs);
$row = $result->fetch_assoc();

if ($row) {  // Check if the query returned any rows
    $po_id = $row['id'];
    $po_supplier = $row['supplier_name'];
    $pdf = $row['pdf'];

    $po_content_query = "SELECT po.*, p.description, p.parent_barcode, c.category_name, b.brand_name FROM purchased_order_content po
                            LEFT JOIN product p ON p.id = po.product_id
                            LEFT JOIN category c ON c.id = p.category
                            LEFT JOIN brand b ON b.id = p.brand 
                            WHERE po_id = '$po_id'";
    $po_content_result = mysqli_query($conn, $po_content_query);
    $orders = [];  // Initialize the array for rows

    if ($po_content_result->num_rows > 0) {
        while ($row = $po_content_result->fetch_assoc()) {
            $orders[] = '<tr>
                            <td><small>' . $row['description'] . '</small></td>
                            <td><small>' . $row['parent_barcode'] . '</small></td>
                            <td><small>' . $row['brand_name'] . '</small></td>
                            <td><small>' . $row['category_name'] . '</small></td>
                            <td><small>' . $row['qty'] . '</small></td>
                        </tr>';
        }
    }

    // Join rows into HTML
    $orderRows = implode("\n", $orders);

    $data = '
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Purchase Order</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <style>
            body { font-family: Arial, sans-serif; margin: 0; padding: 0; display: flex; justify-content: center; align-items: center; background-color: #f8f8f8; }
            .purchase-order {
            width: 100%;
            text-align: center;
            }
            header { text-align: center; margin-bottom: 20px; }
            header h1 { font-size: 1.8em; margin: 0; }
            header p { font-size: 1.2em; color: #555; }
            .company-info { text-align: right; margin: 20px 0; }
            .company-info p { margin-bottom: 0px; }
            .supplier-info { margin: 20px 0; }
            .creator-info { text-align: right; font-size: 0.9em; color: #666; margin-top: 120px;}
            table { width: 100%; border-collapse: collapse; }
            thead th { border: 2px solid black; padding: 10px;}
            thead tr { border: 2px solid black; }
            tbody td { padding: 10px; }
        </style>
    </head>
    <body>
        <div class="purchase-order">
            <header><h1>Purchase Order</h1></header>
            <section class="company-info">
                <p>Purchase Order - ' . $po_id . '</p>
                <p>Date: January 1, 2024</p>
                <p>Company Name</p>
                <p>Company Address</p>
                <p>Contact No.</p>
            </section>
            <section class="supplier-info"><p>Supplier: ' . htmlspecialchars($po_supplier) . '</p></section>
            <table class="table">
                <thead>
                    <tr>
                        <th>Description</th>
                        <th>Parent Barcode</th>
                        <th>Brand</th>
                        <th>Category</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    ' . $orderRows . '
                </tbody>
            </table>
            <section class="creator-info"><p>Requested by: John Jone</p></section>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
    </html>';

    $pdfname = "PO-" . $po_id . " - " . $po_supplier . ".pdf";
    // Initialize mPDF and generate the PDF
    $mpdf = new \Mpdf\Mpdf();
    $mpdf->WriteHTML($data);
    $pdfData = $mpdf->Output('', 'S'); // Get PDF as a string

    // Escape the binary PDF data for insertion into the database
    $pdfData = $conn->real_escape_string($pdfData);
    if (empty($pdf)) {
        $update_po = "UPDATE purchased_order SET pdf = '$pdfData' WHERE id = '$po_id'";
        if ($conn->query($update_po) === TRUE) {
            
            header("location: ../PO-logs/?generate=true");
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }
} else {
    echo "No purchase order found.";
}

$conn->close();
