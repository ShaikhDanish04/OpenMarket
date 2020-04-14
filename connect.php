<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "openmarket";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

date_default_timezone_set('Asia/Kolkata');

session_start();
ob_start();

if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
}

if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
}
