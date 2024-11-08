<?php
// Database connection (adjust with your credentials)
$mysqli = new mysqli('localhost', 'root', '', 'my_database');

// Check for connection error
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Prepare the SQL query to fetch all PDF data where batch_code = 'P123123'
$query = "SELECT unique_barcode, pdf FROM stocks WHERE batch_code = 'P123123'";

// Execute the query
$result = $mysqli->query($query);

// Check if there are any PDFs in the result
if ($result->num_rows > 0) {
    // Create a new ZipArchive object
    $zip = new ZipArchive();
    $zipFileName = 'pdfs_batch_P123123.zip';
    
    // Open the zip file for writing
    if ($zip->open($zipFileName, ZipArchive::CREATE) !== TRUE) {
        exit("Unable to create ZIP file.");
    }

    // Loop through each row and add the PDFs to the ZIP file
    while ($row = $result->fetch_assoc()) {
        $pdfData = $row['pdf'];
        $pdfName = $row['unique_barcode'] . ".pdf";
        
        // Add the PDF to the ZIP file (using the name as the file inside the ZIP)
        $zip->addFromString($pdfName, $pdfData);
    }

    // Close the ZIP file
    $zip->close();

    // Set the appropriate headers for file download
    header('Content-Type: application/zip');
    header('Content-Disposition: attachment; filename="' . $zipFileName . '"');
    header('Content-Length: ' . filesize($zipFileName));

    // Output the ZIP file
    readfile($zipFileName);

    // Optionally delete the ZIP file after download to save space
    unlink($zipFileName);

} else {
    echo "No PDFs found for batch code 'P123123'.";
}

// Close the database connection
$mysqli->close();
?>
