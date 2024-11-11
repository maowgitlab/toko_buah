<?php
  include('../../koneksi.php');
  $id = $_GET['id'];
  $hapus = mysqli_query($koneksi,"DELETE FROM stok_buah WHERE id_stok='$id'");
  if ($hapus) {
    echo "<script>
      alert('Stok telah dihapus');
      window.location='tampil_stok.php';
    </script>";
  }
 ?>
