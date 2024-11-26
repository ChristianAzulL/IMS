<?php
session_start();
$user_position_id = $_SESSION['position_id'];
$user_id = $_SESSION['user_id'];
$user_fullname = $_SESSION['full_name'];
$user_email = $_SESSION['email'];
$user_bday = $_SESSION['birth_date'];
$user_warehouse_ids = explode(",", $_SESSION['warehouse_ids']);
$user_position_name = $_SESSION['position_name'];
$access = $_SESSION['access'];
if(empty($_SESSION['pfp'])){
    $user_pfp = "def_pfp.png";
} else {
    $user_pfp = $_SESSION['pfp'];
}


// Trim any extra whitespace from each ID
$warehouse_ids_array = array_map('trim', $user_warehouse_ids);

// Initialize an array to store the select options
$warehouse_options = [];
$warehouse_options2 = [];

foreach ($warehouse_ids_array as $warehouse_id) {
    // Create the SQL query by directly inserting the warehouse ID
    $sql = "SELECT hashed_id, warehouse_name FROM warehouse WHERE hashed_id = '$warehouse_id'";
    
    // Execute the query
    $result = $conn->query($sql);
    
    if ($result && $row = $result->fetch_assoc()) {
        $warehouse_options[] = '<option value="' . $row['warehouse_name'] . '">' . $row['warehouse_name'] . '</option>';
        $warehouse_options2[] = '<option value="' . $row['hashed_id'] . '">' . $row['warehouse_name'] . '</option>';
    }
}
?>
