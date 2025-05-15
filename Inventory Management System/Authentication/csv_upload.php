<?php
$requiredHeaders = [
    'Order Number', 'Order Line ID', 'Warehouse', 'Client', 'Fulfillment Status'
];

function normalize($str) {
    return strtoupper(trim($str));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    if ($_FILES['file']['error'] !== UPLOAD_ERR_OK) {
        echo 'File upload error.';
        exit;
    }

    $fileTmpPath = $_FILES['file']['tmp_name'];
    $handle = fopen($fileTmpPath, 'r');
    if (!$handle) {
        echo 'Unable to read uploaded file.';
        exit;
    }

    $headers = fgetcsv($handle);
    if (!$headers) {
        echo 'Empty or unreadable file.';
        fclose($handle);
        exit;
    }

    $normalizedHeaders = array_map('normalize', $headers);
    $normalizedRequired = array_map('normalize', $requiredHeaders);

    if ($normalizedHeaders !== $normalizedRequired) {
        echo '<strong>Invalid CSV headers.</strong><br>Expected headers:<br><pre>' . implode(",", $requiredHeaders) . '</pre>';
        fclose($handle);
        exit;
    }

    echo '<table border="1" cellpadding="5" cellspacing="0" style="border-collapse: collapse;">';
    echo '<thead><tr>';
    foreach ($headers as $header) {
        echo '<th>' . htmlspecialchars($header) . '</th>';
    }
    echo '</tr></thead><tbody>';

    while (($row = fgetcsv($handle)) !== false) {
        echo '<tr>';
        foreach ($row as $cell) {
            echo '<td>' . htmlspecialchars($cell) . '</td>';
        }
        echo '</tr>';
    }

    echo '</tbody></table>';
    fclose($handle);
} else {
    echo 'No file received.';
}
?>
