<?php
require 'vendor/autoload.php'; // Load the Picqer Barcode Generator library

use Picqer\Barcode\BarcodeGeneratorPNG;

// Set the header to display the image directly in the browser
header('Content-Type: image/png');

// Define barcode content (this is the value that will appear when scanned)
$unique_barcode = '081231723897-116';

// Create an instance of the barcode generator
$generator = new BarcodeGeneratorPNG();

// Generate the barcode image as raw data
$barcodeData = $generator->getBarcode($unique_barcode, $generator::TYPE_CODE_128);

// === Fixed Background Size (30mm x 10mm @ 300 DPI) ===
$bgWidth = 354;  // 30mm ≈ 354px
$bgHeight = 118; // 10mm ≈ 118px

// === Barcode Size (Easily Adjustable) ===
$barcodeWidth = 350;  // Width of the barcode itself (in pixels)
$barcodeHeight = 70;  // Height of the barcode itself (in pixels)

// === Padding / Margin (Adjust these values for spacing inside the background) ===
$paddingTop = 0;    // Space between barcode and top edge
$paddingBottom = 50; // Space between barcode and bottom edge
$paddingLeft = 0;   // Space between barcode and left edge
$paddingRight = 0;  // Space between barcode and right edge

// === Text Settings (Barcode Value Below the Barcode) ===
$textFontSize = 4; // Font size (1-5 for built-in fonts)
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

// === Output the Final Image to the Browser ===
imagepng($image);

// === Free Memory ===
imagedestroy($image);
imagedestroy($barcodeImage);
imagedestroy($resizedBarcode);
?>
