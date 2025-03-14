<?php
$file = "test.txt";
if (file_put_contents($file, "Hello, World!")) {
    echo "File created successfully!";
} else {
    echo "Failed to create file.";
}
?>
