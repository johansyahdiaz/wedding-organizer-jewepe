<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_wo_jewepe";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
