<?php
include "../config/database.php";
include "../config/on_session.php";
$selected_warehouse_id = $_POST['warehouse'];

$query = "SELECT * FROM warehouse WHERE hashed_id = '$selected_warehouse_id' LIMIT 1";
$result = $conn->query($query);
if($result->num_rows>0){
    $selected_warehouse_name = $row['warehouse_name'];
} 
$_SESSION['selected_warehouse_id'] = $selected_warehouse_id;
$_SESSION['selected_warehouse_name'] = $selected_warehouse_name;

if(isset($selected_warehouse_name)){
    header("Location: ../create-po/");
} else {
    echo "Error: Supplier Name is required.";
}