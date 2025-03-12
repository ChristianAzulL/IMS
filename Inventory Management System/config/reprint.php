<?php
include "database.php"; // Include database connection
include "on_session.php"; // Include session handling

require_once '../../vendor/autoload.php'; // Load mPDF
use Picqer\Barcode\BarcodeGeneratorPNG;

// Set the header to display the image directly in the browser
header('Content-Type: image/png');

if (isset($_GET['product_id'])) {
    $unique_barcodes = $_GET['product_id'];
    
    // Ensure product_ids is an array
    if (!is_array($unique_barcodes)) {
        $unique_barcodes = [$unique_barcodes];
    }

    $barcode_images = []; // Initialize array

    foreach ($unique_barcodes as $unique_barcode) {
        // Create an instance of the barcode generator
        $generator = new BarcodeGeneratorPNG();

        // Generate the barcode image as raw data
        $barcodeData = $generator->getBarcode($unique_barcode, $generator::TYPE_CODE_128);

        // === Fixed Background Size (30mm x 10mm @ 300 DPI) ===
        $bgWidth = 354;  // 30mm ≈ 354px
        $bgHeight = 118; // 10mm ≈ 118px

        // === Barcode Size (Easily Adjustable) ===
        $barcodeWidth = 354;  // Width of the barcode itself (in pixels)
        $barcodeHeight = 118;  // Height of the barcode itself (in pixels)

        // === Padding / Margin (Adjust these values for spacing inside the background) ===
        $paddingTop = 0;    // Space between barcode and top edge
        $paddingBottom = 20; // Space between barcode and bottom edge
        $paddingLeft = 0;   // Space between barcode and left edge
        $paddingRight = 0;  // Space between barcode and right edge

        // === Text Settings (Barcode Value Below the Barcode) ===
        $textFontSize = 5; // Font size (1-5 for built-in fonts)
        $textPadding = 5;  // Space between barcode and text
        $textColor = [0, 0, 0]; // Black color

        // Ensure barcode fits within the background after applying padding
        $maxBarcodeWidth = $bgWidth - ($paddingLeft + $paddingRight);
        $maxBarcodeHeight = $bgHeight - ($paddingTop + $paddingBottom);

        // Adjust barcode size if it exceeds the allowed space
        $barcodeWidth = min($barcodeWidth, $maxBarcodeWidth);
        $barcodeHeight = min($barcodeHeight, $maxBarcodeHeight);

        // === Create a White Background ===
        $image = imagecreatetruecolor($bgWidth, $bgHeight);
        $white = imagecolorallocate($image, 255, 255, 255); // Define white color
        imagefill($image, 0, 0, $white); // Fill background with white

        // === Create Barcode Image from Raw Data ===
        $barcodeImage = imagecreatefromstring($barcodeData);

        // === Resize Barcode to Fit Within the Defined Size ===
        $resizedBarcode = imagecreatetruecolor($barcodeWidth, $barcodeHeight);
        imagefill($resizedBarcode, 0, 0, $white); // Ensure background remains white
        imagecopyresampled($resizedBarcode, $barcodeImage, 0, 0, 0, 0, $barcodeWidth, $barcodeHeight, imagesx($barcodeImage), imagesy($barcodeImage));

        // === Center the Barcode Within the Background (With Padding) ===
        $x = $paddingLeft + (($maxBarcodeWidth - $barcodeWidth) / 2);  // Horizontal centering
        $y = $paddingTop + (($maxBarcodeHeight - $barcodeHeight) / 2); // Vertical centering
        imagecopy($image, $resizedBarcode, $x, $y, 0, 0, $barcodeWidth, $barcodeHeight);

        // === Add Barcode Value Below the Barcode ===
        // Get text dimensions
        $textWidth = imagefontwidth($textFontSize) * strlen($unique_barcode);
        $textHeight = imagefontheight($textFontSize);

        // Calculate text position (centered below barcode)
        $textX = ($bgWidth - $textWidth) / 2;
        $textY = $y + $barcodeHeight + $textPadding;

        // Set text color
        $black = imagecolorallocate($image, $textColor[0], $textColor[1], $textColor[2]);

        // Draw the text onto the image
        imagestring($image, $textFontSize, $textX, $textY, $unique_barcode, $black);

        ob_start(); // Start output buffering
        imagepng($image);
        $barcodeImageData = ob_get_contents(); // Capture the image data
        ob_end_clean(); // Clean the output buffer

        // Convert image data to base64 for embedding in HTML
        $barcodeBase64 = 'data:image/png;base64,' . base64_encode($barcodeImageData);

        // Store the barcode image as an <img> tag in the array
        $barcode_images[] = "<img src='{$barcodeBase64}' alt='{$unique_barcode}'>";

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
                padding:0;
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
        'format' => [30, 10], // Custom paper size (58mm x 30mm)
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
