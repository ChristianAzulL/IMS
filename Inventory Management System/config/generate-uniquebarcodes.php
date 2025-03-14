<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1); 
include "database.php";
include "on_session.php";

require_once '../../vendor/autoload.php'; // Load mPDF
use Picqer\Barcode\BarcodeGeneratorPNG;

// Set the header to display the image directly in the browser
header('Content-Type: image/png');

$start = $_GET['start'];
$end = $_GET['end'];
$barcode = $_GET['barcode'];
$response = array('success' => false, 'message' => 'Something went wrong.');

if (isset($_GET['success']) && $_GET['success'] == 0 && isset($_SESSION['unique_key'])) {
    $uniqueKey = $_SESSION['unique_key'];
    require_once '../../vendor/autoload.php';
    
    // Query to fetch required data
    $query = "
        SELECT 
            s.product_id,
            p.description AS product_description,
            b.brand_name,
            c.category_name
        FROM stocks s
        JOIN product p ON s.product_id = p.hashed_id
        JOIN brand b ON p.brand = b.hashed_id
        JOIN category c ON p.category = c.hashed_id
        WHERE s.unique_key = ? AND s.parent_barcode = ?
        GROUP BY s.product_id, s.unique_key";
  
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $uniqueKey, $barcode);
    $stmt->execute();
    $result = $stmt->get_result();

    // Loop through the results and generate PDFs
    while ($row = $result->fetch_assoc()) {
        $productDescription = $row['product_description'];
        $brandName = $row['brand_name'];
        $categoryName = $row['category_name'];
        $product_id = $row['product_id'];
        $images = [];
        $unique_barcode_query = "SELECT unique_barcode, barcode_extension FROM stocks WHERE product_id = '$product_id' AND unique_key = '$uniqueKey' ";
        $res = $conn->query($unique_barcode_query);
        if($res->num_rows > 0){
            while($row = $res->fetch_assoc()){
                $uniqueBarcode = $row['unique_barcode'];
                $barcode_ext = $row['barcode_extension'];
                if($barcode_ext >= $start && $barcode_ext <= $end){
                    // Create an instance of the barcode generator
                    $generator = new BarcodeGeneratorPNG();

                    // Generate the barcode image as raw data
                    $barcodeData = $generator->getBarcode($uniqueBarcode, $generator::TYPE_CODE_128);

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
                    $textWidth = imagefontwidth($textFontSize) * strlen($uniqueBarcode);
                    $textHeight = imagefontheight($textFontSize);

                    // Calculate text position (centered below barcode)
                    $textX = ($bgWidth - $textWidth) / 2;
                    $textY = $y + $barcodeHeight + $textPadding;

                    // Set text color
                    $black = imagecolorallocate($image, $textColor[0], $textColor[1], $textColor[2]);

                    // Draw the text onto the image
                    imagestring($image, $textFontSize, $textX, $textY, $uniqueBarcode, $black);

                    ob_start(); // Start output buffering
                    imagepng($image);
                    $barcodeImageData = ob_get_contents(); // Capture the image data
                    ob_end_clean(); // Clean the output buffer

                    // Convert image data to base64 for embedding in HTML
                    $barcodeBase64 = 'data:image/png;base64,' . base64_encode($barcodeImageData);

                    // Store the barcode image as an <img> tag in the array
                    $images[] = "<img src='{$barcodeBase64}' alt='{$uniqueBarcode}'>";
                }
            }
        }
        
        // Generate HTML content for PDF
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
                "  . implode('', $images) .  "
        </body>
        </html>";

        // Initialize mPDF with custom paper size for thermal printer (58mm x 30mm) and no margins
        $mpdf = new \Mpdf\Mpdf([
            'format' => [30, 10], // 58mm width x 30mm height
            'margin_left' => 0,
            'margin_right' => 0,
            'margin_top' => 0,
            'margin_bottom' => 0,
        ]);

        $mpdf->WriteHTML($html);

        // Output the PDF for download
        $fileName = preg_replace('/[^A-Za-z0-9_\-]/', '_', "$productDescription - $brandName - $categoryName") . '.pdf';
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="' . $fileName . '"');
        $mpdf->Output($fileName, 'D');
        exit; // Stop execution after sending the first PDF
    }

    $stmt->close();
}

echo json_encode($response); // Return JSON response if no PDF is generated
exit;
?>
