<?php
// Update dengan nama database yang benar
$servername = "localhost";
$username = "root";  // Username MySQL, biasanya 'root'
$password = "";      // Password MySQL, kosong jika tidak ada
$dbname = "manajemen_kontak"; // Ganti dengan nama database yang sudah Anda buat

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
