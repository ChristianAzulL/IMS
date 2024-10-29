<?php
// Set timezone to the Philippines
date_default_timezone_set('Asia/Manila');
// Get the current date and time in MySQL DATETIME format
$currentDateTime = date("Y-m-d H:i:s");

// Database connection (update with your own connection details)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "my_database";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}