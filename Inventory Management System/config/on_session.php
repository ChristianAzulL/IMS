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

?>
