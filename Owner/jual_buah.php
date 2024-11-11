<?php
  session_start();
?>
 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title img="../Icon/store.png" width=16 height=16>Halaman Owner</title>
     <link rel="stylesheet" href="../style.css">
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
            <button class="btnn" onClick="window.location='index.php';"><img src="../Icon/home.png" width=32 height=32><br><b>Beranda</b></button>
            <button class="btnn" onClick="window.location='Buah/tampil_buah.php';"><img src="../Icon/price-tag-4.png" width=32 height=32><br><b>Kelola Buah</b></button>
            <button class="btnn" onClick="window.location='Stok/tampil_stok.php';"><img src="../Icon/cart-14.png" width=32 height=32><br><b>Stok Buah</b></button>
            <button class="btnn" onClick="window.location='detail_pembelian.php';"><img src="../Icon/pie-chart-1.png" width=32 height=32><br><b>Detail Pembelian</b></button>
            <button class="btnn" onClick="window.location='Akun/tampil_akun.php';"><img src="../Icon/agen.png" width=32 height=32><br><b>Kelola Agen</b></button>
            <button class="btnn" onClick="window.location='Pelanggan/tampil_pelanggan.php';"><img src="../Icon/agen.png" width=32 height=32><br><b>Data Pelanggan</b></button>
            <button class="btnn" onClick="window.location='../logout.php';"><img src="../Icon/logout.png" width=32 height=32><br><b>Logout</b></button>
        </div>
     </div>
     <div class="body">
       <div class="form">
         <?php
            include('../koneksi.php');
            $id = $_GET['id'];
            $tampil = mysqli_query($koneksi,"SELECT * FROM stok_buah WHERE id_buah='$id'");
            $data = mysqli_fetch_assoc($tampil);
          ?>
         <form method="post" enctype="multipart/form-data">
         <h3>Beli Buah</h3>
           Nama Buah
           <input type="text" name="nama" class="form-text" value="<?php echo $data['nama_buah']; ?>" readonly style="background-color: rgb(161, 159, 158); font-weight: bold;">
           <!-- Stok -->
           <input type="hidden" name="stok" value="<?php echo $data['jumlah_stok']; ?>" readonly>
           Jumlah Beli
           <input type="number" name="beli" id="beli" class="form-number" onkeyup="hitung();">
           Harga Satuan
           <input type="number" name="satuan" id="satuan" class="form-number" value="<?php echo $data['harga_awal']; ?>" readonly style="background-color: rgb(161, 159, 158); font-weight: bold;">
           Total Harga
           <input type="number" name="total" id="total" class="form-number" readonly style="background-color: rgb(161, 159, 158); font-weight: bold;">
           Pelanggan
           <select name="pelanggan" required>
             <option value="">Pilih</option>
              <?php
                  $sql = mysqli_query($koneksi,"SELECT * FROM tb_pelanggan ORDER BY id_pelanggan ASC");
                  while ($data = mysqli_fetch_assoc($sql)) {
                        echo "<option value=".$data['nama_pelanggan'].">".$data['nama_pelanggan']."</option>";
                      }
               ?>
           </select>
           <!-- Tukang Jual -->
            <input type="hidden" name="user" value="<?php echo $_SESSION['user']; ?>" readonly>
            <!-- tgl_beli -->
            <input type="hidden" name="tgl" value="<?php echo date('Y-m-d H:i:s'); ?>" class="form-text">
            <!-- Status -->
            <input type="hidden" name="sts" value="Diproses">
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
 <!-- Menghitung Otomatis -->
<script type="text/javascript">
  function hitung(){
    var a = document.getElementById('beli').value;
    var b = document.getElementById('satuan').value;
    var hasil = parseInt(a) * parseInt(b);
    if (!isNaN(hasil)) {
        document.getElementById('total').value = hasil;
    }
  }
</script>
<!-- Proses tambah data multi query -->
  <?php
     if (isset($_POST['tambah'])) {
       $nama = $_POST['nama'];
       $stok = $_POST['stok'];
       $jml_beli = $_POST['beli'];
       $satuan = $_POST['satuan'];
       $total = $_POST['total'];
       $pelanggan = $_POST['pelanggan'];
       $user = $_POST['user'];
       $tgl = $_POST['tgl'];
       $sts = $_POST['sts'];
       if ($jml_beli>$stok) {
         echo "<script>
           alert('Upps Jumlah beli melebihi stok');
           window.location='index.php';
         </script>";
       }else if($jml_beli<=$stok){
         $tambah = mysqli_query($koneksi,"INSERT INTO tb_buah VALUES(NULL,'$id','$nama','$jml_beli','$satuan','$stok','$pelanggan','$user','$tgl','$total','$sts')") or die (mysqli_error($koneksi));
         $update = mysqli_query($koneksi,"UPDATE stok_buah SET jumlah_stok=$stok-$jml_beli WHERE stok_buah.id_buah='$id'") or die (mysqli_error($koneksi));
       }
       if ($tambah) {
         echo "<script>
           alert('Buah Telah Dibeli');
           window.location='index.php';
         </script>";
       }else {
         echo "<script>
           alert('Buah Gagal Dibeli');
           window.location='jual_buah.php';
         </script>";
       }
     }
  ?>
