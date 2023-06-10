<!--<?php
// Informasi koneksi database
$host = "localhost"; // Host database
$user = "root"; // User database
$password = ""; // Password database
$database = "db_filesharing"; // Nama database

// Membuat koneksi
$conn = mysqli_connect($host, $user, $password, $database);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi ke database gagal: " . $conn->connect_error);
}

// Operasi database lainnya...

// Menutup koneksi
$conn->close();
?>-->

<?php 
 
$server = "localhost";
$user = "root";
$pass = "";
$database = "db_filesharing";
 
$conn = mysqli_connect($server, $user, $pass, $database);
 
if (!$conn) {
    die("<script>alert('Gagal tersambung dengan database.')</script>");
}
 
?>
