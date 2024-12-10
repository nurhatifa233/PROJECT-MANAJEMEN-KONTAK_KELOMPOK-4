<?php
include 'kontak_functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $nomor = $_POST['nomor'];
    $foto = $_FILES['foto']['name']; // Memasukkan foto kontak
    move_uploaded_file($_FILES['foto']['tmp_name'], "images/$foto");

    tambahKontak($nama, $nomor, $foto);

    header("Location: index.php"); // Kembali ke halaman utama
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kontak</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #121212;
            color: #fff;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .form-container {
            background-color: #333;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 400px;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group input {
            width: 100%;
            padding: 15px;
            font-size: 18px;
            border-radius: 5px;
            border: none;
            background-color: #444;
            color: #fff;
            text-align: center;
        }
        .form-group input[type="file"] {
            padding: 10px;
            font-size: 16px;
        }
        .button-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
        }
        .calc-button {
            background-color: #4CAF50;
            color: #fff;
            padding: 20px;
            font-size: 20px;
            text-align: center;
            border-radius: 10px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .calc-button:hover {
            background-color: #45a049;
        }
        .calc-button:active {
            background-color: #388E3C;
        }
        .calc-button:disabled {
            background-color: #888;
            cursor: not-allowed;
        }
        .form-actions {
            text-align: center;
        }
        .form-actions button {
            padding: 15px 30px;
            background-color: #4CAF50;
            border: none;
            color: white;
            font-size: 18px;
            border-radius: 5px;
            width: 100%;
            margin-top: 20px;
            cursor: pointer;
        }
        .form-actions button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h1>Tambah Kontak Baru</h1>
    <form action="tambah_kontak.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <input type="text" name="nama" id="nama" placeholder="Nama" required>
        </div>
        <div class="form-group">
            <input type="text" name="nomor" id="nomor" placeholder="Nomor Telepon" required>
        </div>
        <div class="form-group">
            <input type="file" name="foto" accept="image/*" id="foto">
        </div>

        <div class="button-container">
            <!-- Tombol Kalkulator untuk memasukkan angka ke nomor telepon -->
            <button type="button" class="calc-button" onclick="addToNumber(1)">1</button>
            <button type="button" class="calc-button" onclick="addToNumber(2)">2</button>
            <button type="button" class="calc-button" onclick="addToNumber(3)">3</button>
            <button type="button" class="calc-button" onclick="addToNumber(4)">4</button>
            <button type="button" class="calc-button" onclick="addToNumber(5)">5</button>
            <button type="button" class="calc-button" onclick="addToNumber(6)">6</button>
            <button type="button" class="calc-button" onclick="addToNumber(7)">7</button>
            <button type="button" class="calc-button" onclick="addToNumber(8)">8</button>
            <button type="button" class="calc-button" onclick="addToNumber(9)">9</button>
            <button type="button" class="calc-button" onclick="addToNumber(0)">0</button>
            <button type="button" class="calc-button" onclick="clearNumber()">C</button>
        </div>

        <div class="form-actions">
            <button type="submit">Tambah Kontak</button>
        </div>
    </form>
</div>

<script>
    // Fungsi untuk menambahkan angka ke nomor telepon
    function addToNumber(number) {
        var nomorInput = document.getElementById('nomor');
        nomorInput.value += number;
    }

    // Fungsi untuk menghapus nomor yang ada
    function clearNumber() {
        var nomorInput = document.getElementById('nomor');
        nomorInput.value = '';
    }
</script>

</body>
</html>
