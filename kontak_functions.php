<?php
// Koneksi ke database
$host = 'localhost';
$dbname = 'manajemen_kontak';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Koneksi gagal: " . $e->getMessage();
}

// Fungsi untuk mengambil daftar kontak dan mengurutkannya berdasarkan nama
function urutkanKontak() {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM kontak ORDER BY nama ASC");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Fungsi untuk mengambil kontak berdasarkan nama yang dimulai dengan pencarian
function getKontakByNama($cari) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM kontak WHERE nama LIKE :cari");
    $stmt->execute(['cari' => $cari . '%']);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Fungsi untuk mengambil kontak berdasarkan ID
function getKontakById($id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM kontak WHERE id = :id");
    $stmt->execute(['id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Fungsi untuk mengupdate kontak
function updateKontak($id, $nama, $nomor, $foto) {
    global $pdo;
    $stmt = $pdo->prepare("UPDATE kontak SET nama = ?, nomor = ?, foto = ? WHERE id = ?");
    $stmt->execute([$nama, $nomor, $foto, $id]);
}

// Fungsi untuk menghapus kontak
function hapusKontak($id) {
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM kontak WHERE id = ?");
    $stmt->execute([$id]);
}

// Fungsi untuk menambahkan kontak
function tambahKontak($nama, $nomor, $foto) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO kontak (nama, nomor, foto) VALUES (?, ?, ?)");
    $stmt->execute([$nama, $nomor, $foto]);
}
?>
