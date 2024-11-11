<?php
  include('../../koneksi.php');
  $id = $_GET['id'];
  $hapus = mysqli_query($koneksi,"DELETE FROM tb_pelanggan WHERE id_pelanggan='$id'");
  if ($hapus) {
    echo "<script>
      alert('Berhasil Dihapus');
      window.location='tampil_pelanggan.php';
    </script>";
  }
 ?>
