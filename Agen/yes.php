<?php
    include('../koneksi.php');
    $id = $_GET['id'];
    $upt = mysqli_query($koneksi,"UPDATE tb_buah SET status='Diproses' WHERE id='$id'") or die (mysqli_error($koneksi));
    // $hapus = mysqli_query($koneksi,"DELETE FROM tb_buah WHERE id='$hapus'");
    if ($upt) {
        echo "<script>
        alert('Data Berhasil Dikonfirmasi');
        window.location='index.php';
        </script>";
    }
?>