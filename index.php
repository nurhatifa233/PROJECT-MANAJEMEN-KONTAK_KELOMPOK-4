<?php
include 'kontak_functions.php';

// Ambil kontak berdasarkan pencarian jika ada
$cari = isset($_POST['cari']) ? $_POST['cari'] : '';

// Ambil daftar kontak (dengan pencarian)
if ($cari) {
    $kontakList = getKontakByNama($cari);
} else {
    // Ambil kontak dan urutkan berdasarkan nama
    $kontakList = urutkanKontak();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Kontak</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #121212;
            color: #fff;
            font-family: Arial, sans-serif;
            text-align: center;
        }
        .kontak-list ul {
            list-style-type: none;
            padding: 0;
        }
        .kontak-list li {
            background-color: #333;
            margin: 10px 0;
            padding: 15px;
            border-radius: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
        }
        .kontak-info {
            flex: 1;
            padding-left: 10px;
            text-align: left;
        }
        .kontak-actions a {
            margin: 0 10px;
            color: #4CAF50;
            font-size: 18px;
            text-decoration: none;
        }
        .kontak-actions a:hover {
            color: #FFC107;
        }
        .kontak-photo {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 10px;
        }
        .footer-buttons {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 30px;
        }
        .footer-buttons .btn {
            background-color: #333;
            color: #fff;
            text-decoration: none;
            padding: 10px 15px;
            border-radius: 5px;
            border: 1px solid #fff;
        }
        .footer-buttons .btn:hover {
            background-color: #444;
            color: #FFC107;
        }
        .floating-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #FF5722;
            color: #fff;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
            font-size: 24px;
            text-decoration: none;
        }
        .floating-button:hover {
            background-color: #e64a19;
        }
        .search-box {
            margin: 20px 0;
        }
        .search-box input {
            padding: 10px;
            width: 300px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        .search-box button {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
        }
        .search-box button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

    <h1>Manajemen Kontak</h1>

    <!-- Form Pencarian -->
    <div class="search-box">
        <form method="POST" action="index.php">
            <input type="text" name="cari" placeholder="Cari berdasarkan nama" value="<?= htmlspecialchars($cari) ?>">
            <button type="submit">Cari</button>
        </form>
    </div>

    <div class="kontak-list">
        <ul>
            <?php foreach ($kontakList as $kontak): ?>
                <li>
                    <div class="kontak-photo">
                        <?php if ($kontak['foto']): ?>
                            <img src="images/<?= $kontak['foto'] ?>" alt="<?= $kontak['nama'] ?>" class="kontak-photo">
                        <?php else: ?>
                            <img src="images/default.png" alt="Foto Default" class="kontak-photo">
                        <?php endif; ?>
                    </div>
                    <div class="kontak-info">
                        <strong><?= $kontak['nama'] ?></strong><br>
                        <span><?= $kontak['nomor'] ?></span>
                    </div>
                    <div class="kontak-actions">
                        <a href="tel:<?= '62' . preg_replace('/[^0-9]/', '', $kontak['nomor']) ?>" title="Panggil">
                            <i class="fas fa-phone-alt"></i>
                        </a>
                        <a href="https://wa.me/<?= '62' . preg_replace('/[^0-9]/', '', $kontak['nomor']) ?>" target="_blank" title="WhatsApp">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                        <a href="edit_kontak.php?id=<?= $kontak['id'] ?>" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="hapus_kontak.php?id=<?= $kontak['id'] ?>" title="Hapus">
                            <i class="fas fa-trash-alt"></i>
                        </a>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <div class="footer-buttons">
        <!-- Tombol untuk Urutkan Kontak -->
        <a href="index.php" class="btn">Urutkan Kontak</a>
    </div>

    <a href="tambah_kontak.php" class="floating-button">+</a>
</body>
</html>
