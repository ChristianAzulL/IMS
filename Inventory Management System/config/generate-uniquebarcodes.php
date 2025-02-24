<?php 
include "database.php";
include "on_session.php";
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
                    $images[] = "<img alt='Barcode' src='../../assets/barcode/barcode.php?codetype=Code128&size=30&text=$uniqueBarcode&print=true'/>";
                }
            }
        }
        
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
