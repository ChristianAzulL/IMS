<?php
try {
    do {
        // Generate a 16-character secure random string
        $unique_key = bin2hex(random_bytes(8));

        // Query to check if the key already exists in the database
        $checking_only = "SELECT id FROM inbound_logs WHERE unique_key = '$unique_key' LIMIT 1";
        $result = $conn->query($checking_only);

        // Check if the key exists; if so, regenerate
    } while ($result->num_rows > 0);

    // Store the unique key in the session
    $_SESSION['unique_key'] = $unique_key;
} catch (Exception $e) {
    // Handle any potential errors (e.g., if the random_bytes function fails)
    echo "Error generating secure key: " . $e->getMessage();
}
?>
