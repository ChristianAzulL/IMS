<?php

require_once '../../vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($data);

// Save a copy to the specified folder
$pdfPath = '../../PDFs/' . $pdfname;
$mpdf->Output($pdfPath, \Mpdf\Output\Destination::FILE); // Saves to ../../PDFs/

// Prompt download for the user
// $mpdf->Output($pdfname, \Mpdf\Output\Destination::DOWNLOAD); // Initiates download
