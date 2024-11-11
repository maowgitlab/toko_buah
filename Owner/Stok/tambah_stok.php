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
            <button class="btnn" onClick="window.location='tampil_stok.php';"><img src="../../Icon/cart-14.png" width=32 height=32><br><b>Stok Buah</b></button>
            <button class="btnn" onClick="window.location='../detail_pembelian.php';"><img src="../../Icon/pie-chart-1.png" width=32 height=32><br><b>Detail Pembelian</b></button>
            <button class="btnn" onClick="window.location='../Akun/tampil_akun.php';"><img src="../../Icon/agen.png" width=32 height=32><br><b>Kelola Agen</b></button>
            <button class="btnn" onClick="window.location='../Pelanggan/tampil_pelanggan.php';"><img src="../..//Icon/agen.png" width=32 height=32><br><b>Data Pelanggan</b></button>
            <button class="btnn" onClick="window.location='../../logout.php';"><img src="../../Icon/logout.png" width=32 height=32><br><b>Logout</b></button>
        </div>
     </div>
     <div class="body">
       <!-- ID Otomatis -->
       <?php
          include('../../koneksi.php');
          $sql = mysqli_query($koneksi,"SELECT max(id_buah) AS kode FROM stok_buah");
          $data = mysqli_fetch_assoc($sql);
          if ($data) {
            $nilaiID = substr($data['kode'],1);
            $ID = (int)$nilaiID;
            $ID = $ID + 1;
            $IDAuto = "B".str_pad($ID,3,"0",STR_PAD_LEFT);
          }else {
            $IDAuto = "B001";
          }
        ?>
          <div class="form">
            <form method="post" enctype="multipart/form-data">
            <h3>Tambah Stok Buah</h3>
              ID Buah
              <input type="text" name="id" class="form-text" value="<?php echo $IDAuto; ?>" readonly>
              Nama Buah
              <input type="text" name="nama_buah" class="form-text" required>
              Gambar buah <br>
              <input type="file" name="gambar"><br><br>
              Jumlah Stok
              <input type="number" name="stok" class="form-number">
              Harga Awal
              <input type="number" name="harga" class="form-number">
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

<!-- Proseses Tambah -->
<?php
  include('../../koneksi.php');
  if (isset($_POST['tambah'])) {
    $id = $_POST['id'];
    $nama_buah = $_POST['nama_buah'];
    $nama_gambar = $_FILES['gambar']['name'];
    $ukuran_gambar = $_FILES['gambar']['size'];
    $tmp_file = $_FILES['gambar']['tmp_name'];
    $ekstensinya = array('png');
    $explode = explode('.',$nama_gambar);
    $ekstensi = strtolower(end($explode));
    $stok = $_POST['stok'];
    $harga_awal = $_POST['harga'];
    if (in_array($ekstensi, $ekstensinya)===true) {
      if ($ukuran_gambar <= 3453042) {
        move_uploaded_file($tmp_file, '../../Icon/'.$nama_gambar);
        $tambah = mysqli_query($koneksi,"INSERT INTO stok_buah VALUES(NULL,'$id','$nama_buah','$nama_gambar','$stok','$harga_awal')");
        if ($tambah) {
          echo "<script>
            alert('Stok Berhasil Ditambahkan');
            window.location='tampil_stok.php';
          </script>";
        }else {
          echo "<script>
            alert('Stok Gagal Ditambahkan');
            window.location='tambah_stok.php';
          </script>";
        }
      }
    }
  }
 ?>
