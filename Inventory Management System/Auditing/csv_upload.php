<?php
$requiredHeaders = [
    'Order Number', 'Order Line ID', 'Warehouse', 'Client', 'Fulfillment Status'
];

function normalize($str) {
    return strtoupper(trim($str));
}

$rows = [];
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    if ($_FILES['file']['error'] !== UPLOAD_ERR_OK) {
        $error = 'File upload error.';
    } else {
        $fileTmpPath = $_FILES['file']['tmp_name'];
        $handle = fopen($fileTmpPath, 'r');

        if (!$handle) {
            $error = 'Unable to read uploaded file.';
        } else {
            $headers = fgetcsv($handle);

            if (!$headers) {
                $error = 'Empty or unreadable file.';
            } else {
                $normalizedHeaders = array_map('normalize', $headers);
                $normalizedRequired = array_map('normalize', $requiredHeaders);

                if ($normalizedHeaders !== $normalizedRequired) {
                    $error = 'Invalid CSV headers. Required headers: ' . implode(', ', $requiredHeaders);
                } else {
                    // Read remaining rows
                    while (($row = fgetcsv($handle)) !== false) {
                        $rows[] = $row;
                    }
                }
            }
            fclose($handle);
        }
    }
} else {
    $error = 'No file received.';
}
?>

<?php if ($error): ?>
    <div style="color: red; font-weight: bold;">
        <?= htmlspecialchars($error) ?>
    </div>
<?php elseif (!empty($rows)): ?>
    <table border="1" cellpadding="5" cellspacing="0" style="border-collapse: collapse;">
        <thead>
            <tr>
                <?php foreach ($requiredHeaders as $header): ?>
                    <th><?= htmlspecialchars($header) ?></th>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rows as $row): ?>
                <tr>
                    <?php foreach ($row as $cell): ?>
                        <td><?= htmlspecialchars($cell) ?></td>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
