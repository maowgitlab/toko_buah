<?php
    include('../../koneksi.php');
    $id_b = $_GET['id_buah'];
    $get = $_GET['id'];
    $a = $_GET['stok'];
    $update_stok = mysqli_query($koneksi,"UPDATE stok_buah SET jumlah_stok='$a' WHERE id_buah='$id_b'") or die (mysqli_error($koneksi));
    $update_buah = mysqli_query($koneksi,"UPDATE tb_buah SET status='Ditolak' WHERE id='$get'") or die (mysqli_error($koneksi));
    if ($update_stok) {
        echo "<script>
        alert('Barang/buah Telah Ditolak');
        window.location='tampil_buah.php';
        </script>";
    }
?>