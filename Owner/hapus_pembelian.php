<?php
  include('../koneksi.php');
  $id = $_GET['id'];
  $hapus = mysqli_query($koneksi,"DELETE FROM detail_pembelian WHERE id_pembelian='$id'");
  if ($hapus) {
    echo "<script>
      alert('Berhasil dihapus');
      window.location='detail_pembelian.php';
    </script>";
  }
 ?>
