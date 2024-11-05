<?php
include "../config/database.php";
include "../config/on_session.php";
$selected_warehouse_id = $_POST['warehouse'];
$selected_warehouse_name = "Sample Supplier";

$_SESSION['selected_warehouse_id'] = $selected_warehouse_id;
$_SESSION['selected_warehouse_name'] = $selected_warehouse_name;

if(isset($selected_warehouse_name)){
    header("Location: ../create-po/");
} else {
    echo "Error: Supplier Name is required.";
}