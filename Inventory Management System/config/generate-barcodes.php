<?php 
include "database.php";
include "on_session.php";

$response = array('success' => false, 'message' => 'Something went wrong.');

if (isset($_GET['success']) && $_GET['success'] == 0 && isset($_SESSION['unique_key'])) {
    $uniqueKey = $_SESSION['unique_key'];
    require_once '../../vendor/autoload.php';
    
    // Query to fetch required data
    $query = "
        SELECT 
            s.unique_barcode,
            p.description AS product_description,
            b.brand_name,
            c.category_name
        FROM stocks s
        JOIN product p ON s.product_id = p.hashed_id
        JOIN brand b ON p.brand = b.hashed_id
        JOIN category c ON p.category = c.hashed_id
        WHERE s.unique_key = ?";
  
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $uniqueKey);
    $stmt->execute();
    $result = $stmt->get_result();

    // Create a temporary directory for PDFs
    $zip = new ZipArchive();
    $zipFile = tempnam(sys_get_temp_dir(), 'pdf_zip_') . '.zip';
    $zip->open($zipFile, ZipArchive::CREATE);

    // Loop through the results and generate PDFs
    while ($row = $result->fetch_assoc()) {
        $uniqueBarcode = $row['unique_barcode'];
        $productDescription = $row['product_description'];
        $brandName = $row['brand_name'];
        $categoryName = $row['category_name'];

        // Generate HTML content for PDF
        $html = "
        <html>
        <head>
            <style>
                img {
                    max-width: 100%;
                    max-height: 100%;
                    object-fit: contain;
                }
            </style>
        </head>
        <body>
                <img alt='Barcode' src='../../assets/barcode/barcode.php?codetype=Code128&size=20&text=$uniqueBarcode&print=true'/>
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

        // Save the PDF to a temporary file
        $fileName = preg_replace('/[^A-Za-z0-9_\-]/', '_', "$productDescription - $brandName - $categoryName - $uniqueBarcode") . '.pdf';
        $pdfPath = sys_get_temp_dir() . '/' . $fileName;
        $mpdf->Output($pdfPath, 'F');

        // Add the file to the ZIP archive
        $zip->addFile($pdfPath, $fileName);
    }

    $zip->close();
    $stmt->close();

    // Output the ZIP for download
    header('Content-Type: application/zip');
    header('Content-Disposition: attachment; filename="Products.zip"');
    header('Content-Length: ' . filesize($zipFile));
    readfile($zipFile);

    // Cleanup
    unlink($zipFile); // Delete ZIP file after download

    // Send success response
    $response = array('success' => true, 'message' => 'Barcodes generated successfully.');
}

echo json_encode($response); // Return JSON response
exit;
?>
