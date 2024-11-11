<?php
    include('../koneksi.php');
    $hapus = $_GET['id'];
    $id = $_GET['id_buah'];
    $a = $_GET['stok'];
    $update_stok = mysqli_query($koneksi,"UPDATE stok_buah SET jumlah_stok='$a' WHERE id_buah='$id'") or die (mysqli_error($koneksi));
    $hapus = mysqli_query($koneksi,"DELETE FROM tb_buah WHERE id='$hapus'");
    if ($update_stok) {
        echo "<script>
        alert('Barang/buah Berhasil Dibatalkan');
        window.location='index.php';
        </script>";
    }
?>