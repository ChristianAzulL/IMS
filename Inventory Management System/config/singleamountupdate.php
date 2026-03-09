<?php
include "database.php";
include "on_session.php";

$parent = $_POST['parent_barcode'];
$ext = $_POST['sequence'];
$amount = $_POST['new_amount'];

$sql = "
UPDATE stocks 
SET capital='$amount'
WHERE parent_barcode='$parent'
AND barcode_extension='$ext'
";

mysqli_query($conn,$sql);

$rows = mysqli_affected_rows($conn);

$_SESSION['updates'][] = [
"parent"=>$parent,
"ext"=>$ext,
"amount"=>$amount,
"rows"=>$rows
];

echo json_encode([
"parent"=>$parent,
"ext"=>$ext,
"amount"=>$amount,
"rows"=>$rows
]);