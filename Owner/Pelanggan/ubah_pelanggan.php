<?php
  session_start();
  if (!isset($_SESSION['user'])) {
    echo "<script>
      alert('Anda Harus Login Dulu...');
      window.location='../../login.php';
    </script>";
  }
 ?>
 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title img="../Icon/store.png" width=16 height=16>Halaman Owner</title>
     <link rel="stylesheet" href="../../style.css">
   </head>
   <body>
   <!-- Open CSS -->
     <div class="header">

     </div>
     <div class="sidebar">
       <div class="status">
         Status           :<?php echo $_SESSION['status']; ?> <br>
         Waktu & Tanggal  : <?php $sekarang = date('Y-m-d H:i:s'); echo $sekarang; ?>
       </div>
         <div class="btn-group">
            <button class="btnn" onClick="window.location='../index.php';"><img src="../../Icon/home.png" width=32 height=32><br><b>Beranda</b></button>
            <button class="btnn" onClick="window.location='../Buah/tampil_buah.php';"><img src="../../Icon/price-tag-4.png" width=32 height=32><br><b>Kelola Buah</b></button>
            <button class="btnn" onClick="window.location='../Stok/tampil_stok.php';"><img src="../../Icon/cart-14.png" width=32 height=32><br><b>Stok Buah</b></button>
            <button class="btnn" onClick="window.location='../detail_pembelian.php';"><img src="../../Icon/pie-chart-1.png" width=32 height=32><br><b>Detail Pembelian</b></button>
            <button class="btnn" onClick="window.location='../Akun/tampil_akun.php';"><img src="../../Icon/agen.png" width=32 height=32><br><b>Kelola Agen</b></button>
            <button class="btnn" onClick="window.location='../Pelanggan/tampil_pelanggan.php';"><img src="../../Icon/pelanggan.png" width=32 height=32><br><b>Data Pelanggan</b></button>
            <button class="btnn" onClick="window.location='../../logout.php';"><img src="../../Icon/logout.png" width=32 height=32><br><b>Logout</b></button>
        </div>
     </div>
     <div class="body">
       <?php
          include('../../koneksi.php');
          if (empty($_GET['id'])) {
            echo "<script>
              alert('Pilih dulu data yang ingin diubah');
              window.location='tampil_pelanggan.php';
            </script>";
          }else {
            $id = $_GET['id'];
            $tampil = mysqli_query($koneksi,"SELECT * FROM tb_pelanggan WHERE id_pelanggan='$id'");
            $data = mysqli_fetch_assoc($tampil);
          }
          if (isset($_POST['ubah'])) {
            $idpel = $_POST['id'];
            $nama = $_POST['nama'];
            $jenkel = $_POST['jenkel'];
            $hp = $_POST['hp'];

            $ubah = mysqli_query($koneksi,"UPDATE tb_pelanggan SET nama_pelanggan='$nama',jenkel='$jenkel',
                                            no_hp='$hp' WHERE id_pelanggan='$idpel'") or die (mysqli_error($koneksi));
            if ($ubah) {
              echo "<script>
                alert('Data berhasil Diubah');
                window.location='tampil_pelanggan.php';
              </script>";
            }
          }
        ?>
          <div class="form">
            <form method="post">
            <h2>Ubah Data Pelanggan / Pembeli</h2>
              ID Pelanggan
              <input type="text" name="id" class="form-text" value="<?php echo $data['id_pelanggan']; ?>" readonly>
              Nama Pelanggan
              <input type="text" name="nama" class="form-text" value="<?php echo $data['nama_pelanggan']; ?>" required>
              Jenis Kelamin <br>
              <input type="radio" name="jenkel" value="L" class="form-radio" <?php if($data['jenkel']=="L"){ echo "checked"; } ?>>Laki-Laki
              <input type="radio" name="jenkel" value="P" class="form-radio" <?php if($data['jenkel']=="P"){ echo "checked"; } ?>>Perempuan <br><br>
              Nomer Hp
              <input type="number" name="hp" class="form-number" value="<?php echo $data['no_hp']; ?>">
              <input type="submit" name="ubah" value="Ubah" class="btn-tambah">
            </form>
          </div>
     </div>
     <div class="footer">
       <center><h2>&copy;SMK Negeri 4 Banjarmasin</h2></center>
     </div>
     <!-- Close CSS -->
   </body>
 </html>
