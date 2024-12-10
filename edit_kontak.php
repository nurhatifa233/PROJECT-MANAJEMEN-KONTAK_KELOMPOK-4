<?php
include 'kontak_functions.php';

// Ambil ID kontak yang akan diedit
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $kontak = getKontakById($id);
}

// Proses pengeditan data kontak
if (isset($_POST['edit'])) {
    $nama = $_POST['nama'];
    $nomor = $_POST['nomor'];
    $foto = $_FILES['foto']['name'];

    // Upload foto
    if ($foto) {
        move_uploaded_file($_FILES['foto']['tmp_name'], 'images/' . $foto);
    } else {
        $foto = $kontak['foto']; // Jika foto tidak diubah, tetap pakai foto lama
    }

    updateKontak($id, $nama, $nomor, $foto);
    header('Location: index.php');
    exit();
}

// Proses penghapusan data kontak
if (isset($_POST['hapus'])) {
    hapusKontak($id);
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kontak</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        /* Style untuk halaman edit kontak */
        body {
            background-color: #121212;
            color: #fff;
            font-family: Arial, sans-serif;
            text-align: center;
        }
        .form-container {
            background-color: #333;
            padding: 20px;
            border-radius: 10px;
            width: 50%;
            margin: 0 auto;
        }
        .form-container input, .form-container button {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: none;
        }
        .form-container button {
            background-color: #4CAF50;
            color: white;
            font-size: 16px;
        }
        .form-container button:hover {
            background-color: #45a049;
        }
        .hapus {
            background-color: #FF5722;
            color: white;
        }
        .hapus:hover {
            background-color: #e64a19;
        }
    </style>
</head>
<body>
    <h1>Edit Kontak</h1>
    
    <div class="form-container">
        <form method="POST" enctype="multipart/form-data">
            <input type="text" name="nama" value="<?= $kontak['nama'] ?>" placeholder="Nama" required>
            <input type="text" name="nomor" value="<?= $kontak['nomor'] ?>" placeholder="Nomor Kontak" required>
            <input type="file" name="foto" placeholder="Foto Kontak">
            <button type="submit" name="edit">Simpan Perubahan</button>
        </form>

        <form method="POST">
            <button type="submit" name="hapus" class="hapus">Hapus Kontak</button>
        </form>
    </div>
</body>
</html>
