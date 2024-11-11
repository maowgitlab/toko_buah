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
     <title>Stok Buah</title>
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
            <button class="btnn" onClick="window.location='../Pelanggan/tampil_pelanggan.php';"><img src="../../Icon/pelanggan.png" width=32 height=32><br><b>Data Pelanggan</b></button>
            <button class="btnn" onClick="window.location='../../logout.php';"><img src="../../Icon/logout.png" width=32 height=32><br><b>Logout</b></button>
        </div>
     </div>
     <div class="body">
       <center><h3>Kelola Stok Buah</h3></center>
       <div class="pencarian">
         <form method="get">
           <input type="text" name="key" class="cari" placeholder="search..." required>
           <button type="submit" name="cari" class="btn-cari"><img src="../../Icon/cari.png" width=16 height=16></button>&nbsp;
         </form><br>
         <a href="tampil_stok.php"><img src="../../Icon/refresh.png" width=32 height=32></a><br>
       </div>
       <a class="btn-add" href="tambah_stok.php">Tambah Stok</a> <a href="cetak_stok.php" class="btn-cetak">Cetak data</a><br><br>
       <table border="1" cellpadding=4 cellspacing=0 width=95% align=center>
         <tr>
           <th>No</th>
           <th>ID Buah</th>
           <th>Nama Buah</th>
           <th>Gambar</th>
           <th>Jumlah Stok</th>
           <th>Harga Awal</th>
           <th>Opsi</th>
         </tr>
         <?php
            include('../../koneksi.php');
            if (isset($_GET['cari'])) {
              $key = $_GET['key'];
              $cari = "SELECT * FROM stok_buah WHERE nama_buah LIKE '%$key%'";
            }else {
              $cari = "SELECT * FROM stok_buah";
            }
            $row = 5;
            $halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
            $mulai = ($halaman > 1) ? ($halaman * $row) - $row         : 0;
            $tampil1 = mysqli_query($koneksi,$cari);
            $result = mysqli_num_rows($tampil1);
            $get_hal = ceil($result/$row);
            $tampil2 = mysqli_query($koneksi,"SELECT * FROM stok_buah LIMIT $mulai,$row");
            $no = $mulai + 1;
            if ($result == 0) {
              echo "<tr><td colspan=7>Data Kosong</td></tr>";
            }else {
              if (isset($_GET['cari'])) {
                $sql = $tampil1;
              }else {
                $sql = $tampil2;
              }
              while ($data = mysqli_fetch_row($sql)) {
                echo "<tr>
                          <td>".$no++."</td>
                          <td>".$data[1]."</td>
                          <td>".$data[2]."</td>
                          <td>".$data[3]."</td>
                          <td>".$data[4]."</td>
                          <td>".$data[5]."</td>
                          <td><a class='btn-link' href='ubah_stok.php?id=".$data[0]."''><img src='../../Icon/edit.png' width=32 height=32></a>
                              <a href='hapus_stok.php?id=".$data[0]."'";?>
                              onClick="return confirm('Mau Hapus data Stok ini ?')"</a><img src="../../Icon/hapus.png" width="32" height="32"></td>
                </tr><?php
              }
            }
          ?>
       </table>
       <center>
            <?php for ($i=1; $i <= $get_hal ; $i++) { ?>
              <a href="?halaman=<?php echo $i; ?>"><?php echo $i; ?></a>
          <?php  } ?>
       </center>
     </div>
     <div class="footer">
       <center><h2>&copy;SMK Negeri 4 Banjarmasin</h2></center>
     </div>
     <!-- Close CSS -->
   </body>
 </html>
