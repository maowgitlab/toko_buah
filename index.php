<?php include('koneksi.php'); 
session_start();?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Selamat Datang</title>
    <link rel="stylesheet" href="index.css">
  </head>
  <body>
      <div class="topnav">
        <a href="index.php">Home</a>
        <?php
          if (!isset($_SESSION['status'])) {
            echo "";
          }else {
            echo "<a href='Agen/index.php'>Dasbord Agen</a>";
          }
        ?>
        <?php 
          if (isset($_SESSION['status'])) {
            echo "<a class='active' href='logout.php'>Logout</a>";
          }else {
            echo "<a class='active' href='login.php'>Login</a>";
          }
        ?>
        <!-- <a class="active" href="login.php">Login</a> -->
      </div>
      <div class="badan">
        <div class="detail">
          <marquee direction="right" scrollamount="12">Selamat Datang Ditoko Buah Kami :) </marquee>
        </div>
        <div class="txt"><p>Dibawah Ini Adalah Buah atau barang yang Kami jual di Toko kami
           Beserta Stok yang telah Kami sediakan. jadi, tunggu apalagi
           Ayo Bergabung menjadi agen di Toko Kami dan dapatkan Keuntungannya
           Jika ingin Berlangganan Saja Silahkan Hubungi Pemilik Toko(Owner)</p>
         </div>
        <?php
           $row = 4;
           $halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
           $mulai = ($halaman > 1) ? ($halaman * $row) - $row         : 0;
           $tampil1 = mysqli_query($koneksi,"SELECT * FROM stok_buah");
           $result = mysqli_num_rows($tampil1);
           $per_hal = ceil($result/$row);
           $tampil2 = mysqli_query($koneksi,"SELECT * FROM stok_buah ORDER BY id_stok DESC LIMIT $mulai, $row");
           while ($data = mysqli_fetch_assoc($tampil2)) {
             echo "<div class='gallery'>
                     <b>".$data['nama_buah']."</b>
                     <img src='Icon/".$data['gambar_buah']."'' width=220px height=190px>
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
  </body>
</html>
