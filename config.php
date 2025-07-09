<?php
$host = 'localhost';
$user = 'root';
$password = ''; // atau ikut setting anda
$dbname = 'veelo'; // <-- Guna veelo sebagai nama database

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
  die("Sambungan gagal: " . $conn->connect_error);
}
?>
