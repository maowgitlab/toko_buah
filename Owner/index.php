<?php
  session_start();
  if (!isset($_SESSION['user'])) {
    echo "<script>
      alert('Anda Harus Login Dulu...');
      window.location='../login.php';
    </script>";
  }
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
            <button class="btnn" onClick="window.location='Pelanggan/tampil_pelanggan.php';"><img src="../Icon/pelanggan.png" width=32 height=32><br><b>Data Pelanggan</b></button>
            <button class="btnn" onClick="window.location='../logout.php';"><img src="../Icon/logout.png" width=32 height=32><br><b>Logout</b></button>
        </div>
     </div>
     <div class="body">
       <div class="keuntungan">
         <?php
            include('../koneksi.php');
            $tampil = mysqli_query($koneksi,"SELECT sum(total_harga) AS total FROM detail_pembelian");
            $data = mysqli_fetch_assoc($tampil);
          ?>
          <?php
              if ($data['total']==0) {
                echo "<marquee direction='right' scrollamount='10'><h3>Total Kuntungan :Tidak Ada Pelanggan yang beli maka tidak ada untung :( </h3></marquee>";
              }else {
                echo "<marquee direction='right' scrollamount='10'><h3>Total Kuntungan :&nbsp;IDR-".$data['total']."</h3></marquee>";
              }
           ?>
       </div>
       <div class="pencarian">
         <form method="get">
           <input type="text" name="key" class="cari" placeholder="search..." required>
           <button type="submit" name="cari" class="btn-cari"><img src="../../Icon/cari.png" width=16 height=16></button><br><br>
           <a href="index.php"><img src="../Icon/refresh.png" width=32 height=32></a><br>
         </form>
         
     </div>
     <?php 
        include('../koneksi.php');
        $sql = mysqli_query($koneksi,"SELECT * FROM stok_buah");
        $result = mysqli_num_rows($sql);
        if ($result == 0) {
          echo "";
        }else {
          echo "<a class='btn-cetak' href='cetak_index.php'>Cetak Data</a><br><br>";
        }
       ?>
       <?php
          include('../koneksi.php');
          if (isset($_GET['cari'])) {
            $key = $_GET['key'];
            $cari = "SELECT * FROM stok_buah WHERE nama_buah LIKE '%$key%'";
          }else {
            $cari = "SELECT * FROM stok_buah";
          }
          $row = 4;
          $halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
          $mulai = ($halaman > 1) ? ($halaman * $row) - $row         : 0;
          $tampil1 = mysqli_query($koneksi,$cari) or die (mysqli_error($koneksi));
          $result = mysqli_num_rows($tampil1);
          $per_hal = ceil($result/$row);
          $tampil2 = mysqli_query($koneksi,"SELECT * FROM stok_buah ORDER BY id_stok DESC LIMIT $mulai, $row");
          if (isset($_GET['cari'])) {
            $sql = $tampil1;
          }else {
            $sql = $tampil2;
          }
          while ($data = mysqli_fetch_assoc($sql)) {
            echo "<div class='gallery'>
                    <b>".$data['nama_buah']."</b>
                    <img src='../Icon/".$data['gambar_buah']."'' width=220px height=190px>
                    <p>Stok Tersisa :";?> <?php if ($data['jumlah_stok']==0) {
                                                      echo "Stok habis";
                                                    } else if ($data['jumlah_stok']){
                                                      echo $data['jumlah_stok'];
                                                      echo "<div class='desc'><p><a href='jual_buah.php?id=".$data['id_buah']."'>Beli Buah/Lihat</a></div>";
                                                  }?></p>
            </div><?php
          }
        ?>
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        <center>
          <?php for ($i=1; $i <= $per_hal ; $i++) { ?>
            <a href="?halaman=<?php echo $i; ?>" class="pagingg"><?php echo $i; ?></a>
          <?php   } ?>
        </center>
     </div>
     <div class="footer">
       <center><h2>&copy;SMK Negeri 4 Banjarmasin</h2></center>
     </div>
     <!-- Close CSS -->
   </body>
 </html>
