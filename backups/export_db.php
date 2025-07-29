<?php
// Database config
$dbUser = 'root';
$dbPass = '';
$dbName = 'lpo_db';

// Temp file name
$timestamp = date('Ymd_His');
$filename = "lpo_db_$timestamp.sql";

// Command - adjust path to mysqldump
$dumpCommand = "/opt/lampp/bin/mysqldump -u$dbUser -p$dbPass $dbName";

// Run the dump command and capture output
$dump = shell_exec($dumpCommand);

// Send headers for download
header('Content-Type: application/sql');
header("Content-Disposition: attachment; filename=\"$filename\"");
header('Content-Length: ' . strlen($dump));

// Send the SQL content to the browser
echo $dump;
exit;
?>
