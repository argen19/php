<?php
$host = "localhost";
$dbUser = "root";
$dbPass = "";
$dbName = "activity_b_db";

$conn = mysqli_connect($host, $dbUser, $dbPass, $dbName);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>