<?php
include "database.php";
include "on_session.php";

$parent = $_POST['parent_barcode2'];
$from = $_POST['from'];
$to = $_POST['to'];
$amount = $_POST['new_amount2'];

$sql = "
UPDATE stocks
SET capital='$amount'
WHERE parent_barcode='$parent'
AND barcode_extension BETWEEN '$from' AND '$to'
";

mysqli_query($conn,$sql);

$rows = mysqli_affected_rows($conn);

$range = $from."-".$to;

$_SESSION['updates'][] = [
"parent"=>$parent,
"ext"=>$range,
"amount"=>$amount,
"rows"=>$rows
];

echo json_encode([
"parent"=>$parent,
"ext"=>$range,
"amount"=>$amount,
"rows"=>$rows
]);