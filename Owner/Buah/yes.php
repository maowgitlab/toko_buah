<?php
    include('../../koneksi.php');
    $id = $_GET['id'];
    $akun = $_GET['akun'];
    $pembeli = $_GET['pembeli'];
    $buah = $_GET['buah'];
    $total = $_GET['total_harga'];
    $tgl = $_GET['tgl'];
    $upt = mysqli_query($koneksi,"UPDATE tb_buah SET status='Barang / buah telah dikirim' WHERE id='$id'") or die (mysqli_error($koneksi)); 
    $insert = mysqli_query($koneksi,"INSERT INTO detail_pembelian VALUES (NULL,'$akun','$pembeli','$buah','$total','$tgl')");
    if ($upt) {
        echo "<script>
        alert('Data Berhasil Dikonfirmasi ke Agen');
        window.location='tampil_buah.php';
        </script>";
    }
?>