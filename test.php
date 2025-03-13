<?php
require 'vendor/autoload.php'; // Load the Picqer Barcode Generator library

use Picqer\Barcode\BarcodeGeneratorPNG;

// Set the header to display the image directly in the browser
header('Content-Type: image/png');

// Define barcode content
$unique_barcode = '081231723897-116';

// Create an instance of the barcode generator
$generator = new BarcodeGeneratorPNG();

// === Adjust Barcode Line Thickness ===
// Scale factor affects the thickness (default = 2, increase for thicker bars)
$scaleFactor = 1;  // Higher = thicker lines

// Generate the barcode with adjusted thickness
$barcodeData = $generator->getBarcode($unique_barcode, $generator::TYPE_CODE_128, $scaleFactor);

// === Fixed Background Size (30mm x 7mm @ 300 DPI) ===
$bgWidth = 354;  // 30mm ≈ 354px
$bgHeight = 73;  // 7mm ≈ 83px

// === Create a White Background ===
$image = imagecreatetruecolor($bgWidth, $bgHeight);
$white = imagecolorallocate($image, 255, 255, 255); // Define white color
imagefill($image, 0, 0, $white); // Fill background with white

// === Create Barcode Image from Raw Data ===
$barcodeImage = imagecreatefromstring($barcodeData);

// === Resize Barcode to Fully Fit the Background ===
$resizedBarcode = imagecreatetruecolor($bgWidth, $bgHeight);
imagefill($resizedBarcode, 0, 0, $white); // Ensure background remains white
imagecopyresampled($resizedBarcode, $barcodeImage, 0, 0, 0, 0, $bgWidth, $bgHeight, imagesx($barcodeImage), imagesy($barcodeImage));

// === Place the Barcode Directly onto the Background ===
imagecopy($image, $resizedBarcode, 0, 0, 0, 0, $bgWidth, $bgHeight);

// === Output the Final Image to the Browser ===
imagepng($image);

// === Free Memory ===
// imagedestroy($image);
// imagedestroy($barcodeImage);
// imagedestroy($resizedBarcode);
?>
