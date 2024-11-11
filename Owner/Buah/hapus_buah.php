<?php
  include('../../koneksi.php');
  $id = $_GET['id'];
  $hapus = mysqli_query($koneksi,"DELETE FROM tb_buah WHERE id='$id'");
  if ($hapus) {
    echo "<script>
      alert('Berhasil hapus data ini');
      window.location='tampil_buah.php';
    </script>";
  }
 ?>
