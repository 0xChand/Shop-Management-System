<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shop_management";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Database Connection Failed: " . mysqli_connect_error());
}
?>
