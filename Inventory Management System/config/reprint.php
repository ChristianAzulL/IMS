<?php
include "database.php"; // Include database connection
include "on_session.php"; // Include session handling

require_once '../../vendor/autoload.php'; // Load mPDF

if (isset($_GET['product_id'])) {
    $unique_barcodes = $_GET['product_id'];
    
    // Ensure product_ids is an array
    if (!is_array($unique_barcodes)) {
        $unique_barcodes = [$unique_barcodes];
    }

    $barcode_images = []; // Initialize array

    foreach ($unique_barcodes as $unique_barcode) {
        $barcode_images[] = "<img alt='Barcode' src='../../assets/barcode/barcode.php?codetype=Code128&size=60&text=$unique_barcode&print=true'/>";
    }

    // Generate HTML for PDF
    $html = "
    <html>
    <head>
        <style>
            body {
                text-align: center;
            }
            img {
                max-width: 100%;
                max-height: 100%;
                object-fit: contain;
            }
        </style>
    </head>
    <body>
        " . implode('', $barcode_images) . "
    </body>
    </html>";

    // Create mPDF instance
    $mpdf = new \Mpdf\Mpdf([
        'format' => [18, 10], // Custom paper size (58mm x 30mm)
        'margin_left' => 0,
        'margin_right' => 0,
        'margin_top' => 0,
        'margin_bottom' => 0,
    ]);

    $mpdf->WriteHTML($html);
    $pdf_content = $mpdf->Output('', 'S'); // Generate PDF as string


    // Output PDF for download
    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="Product_Barcodes.pdf"');
    echo $pdf_content;
    exit;
}

echo "No product IDs received.";
?>
