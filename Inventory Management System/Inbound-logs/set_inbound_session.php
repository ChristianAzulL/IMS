<?php
session_start();

// Check if all required POST variables are set
if (isset($_POST['supplier'], $_POST['po_id'], $_POST['received_date'], $_POST['warehouse'])) {
    // Sanitize and save each POST value in SESSION with 'inbound_' prefix
    $_SESSION['inbound_supplier'] = htmlspecialchars($_POST['supplier']);
    $_SESSION['inbound_po_id'] = (int)$_POST['po_id'];  // Ensuring it's an integer
    $_SESSION['inbound_received_date'] = htmlspecialchars($_POST['received_date']);
    $_SESSION['inbound_warehouse'] = htmlspecialchars($_POST['warehouse']);
   
    // Redirect to a confirmation or next step page if needed
    header("Location: ../inbound-select-products/");
    exit();
} else {
    // Redirect back to the form or show an error message if required fields are missing
    echo "Error: Please fill in all required fields.";
}
