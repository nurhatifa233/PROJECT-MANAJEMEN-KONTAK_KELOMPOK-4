<?php
include 'kontak_functions.php';

// Validasi apakah parameter ID tersedia
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Periksa apakah kontak dengan ID tersebut ada
    $kontak = getKontakById($id);
    if ($kontak) {
        hapusKontak($id);
        header('Location: index.php?message=success');
    } else {
        header('Location: index.php?message=notfound');
    }
} else {
    header('Location: index.php?message=invalidid');
}
exit();
?>
