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
       <!-- ID Otomatis -->
       <?php
          include('../../koneksi.php');
          $sql = mysqli_query($koneksi,"SELECT max(id_pelanggan) AS kode FROM tb_pelanggan");
          $data = mysqli_fetch_assoc($sql);
          if ($data) {
            $nilaiID = substr($data['kode'],1);
            $ID = (int)$nilaiID;
            $ID = $ID + 1;
            $IDAuto = "P".str_pad($ID,3,"0",STR_PAD_LEFT);
          }else {
            $IDAuto = "P001";
          }
        ?>
          <div class="form">
            <form method="post">
            <h2>Tambah Pelanggan / Pembeli</h2>
              ID Pelanggan
              <input type="text" name="id" class="form-text" value="<?php echo $IDAuto; ?>" readonly>
              Nama Pelanggan
              <input type="text" name="nama" class="form-text" maxlength="10">
              Jenis Kelamin <br>
              <input type="radio" name="jenkel" value="L" class="form-radio">Laki-Laki
              <input type="radio" name="jenkel" value="P" class="form-radio">Perempuan <br><br>
              Nomer Hp
              <input type="number" name="hp" class="form-number">
              Tanggal_beli
              <input type="date" name="tanggal" class="form-text">
              <input type="submit" name="tambah" value="Tambah" class="btn-tambah">
            </form>
          </div>
     </div>
     <div class="footer">
       <center><h2>&copy;SMK Negeri 4 Banjarmasin</h2></center>
     </div>
     <!-- Close CSS -->
   </body>
 </html>
 <!-- Proses tambah pelanggan -->
<?php
  if (isset($_POST['tambah'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $jenkel = $_POST['jenkel'];
    $hp = $_POST['hp'];
    $tgl = $_POST['tanggal'];

    $tambah = mysqli_query($koneksi,"INSERT INTO tb_pelanggan VALUES('$id','$nama','$jenkel','$hp','$tgl')") or die (mysqli_error($koneksi));
    if ($tambah) {
      echo "<script>
        alert('Data Pelanggan Berhasil Ditambahkan..');
        window.location='tampil_pelanggan.php';
      </script>";
    }
  }
 ?>
