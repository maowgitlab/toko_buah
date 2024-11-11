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
            <button class="btnn" onClick="window.location='detail_pembelian.php';"><img src="../Icon/pie-chart-1.png" width=32 height=32><br><b>Detail Pembelian</b></button>
            <button class="btnn" onClick="window.location='../index.php';"><img src="../Icon/logout.png" width=32 height=32><br><b>Kembali</b></button>
        </div>
     </div>
     <div class="body">
       <center><h3>Detail Pembelian Pelanggan</h3></center>
       <div class="pencarian">
         <form method="get">
           <input type="text" name="key" class="cari" placeholder="search..." required>
           <button type="submit" name="cari" class="btn-cari"><img src="../Icon/cari.png" width=16 height=16></button>&nbsp;
         </form><br>
         <a href="detail_pembelian.php"><img src="../Icon/refresh.png" width=32 height=32></a><br>
       </div>
       <table border="1" cellpadding=4 cellspacing=0 align=center width=95%>
         <tr>
           <th>No</th>
           <th>Tukang Jual</th>
           <th>Nama Pelanggan</th>
           <th>Buah Yang Dibeli</th>
           <th>Total Harga</th>
           <th>Tanggal beli</th>
         </tr>
         <?php
            include('../koneksi.php');
            if (isset($_GET['cari'])) {
              $key = $_GET['key'];
              $cari = "SELECT * FROM detail_pembelian WHERE id_akun LIKE '%$key%' OR 
                        id_pembeli LIKE '%$key%'";
            }else {
              $cari = "SELECT * FROM detail_pembelian";
            }
            $row = 5;
            $halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
            $mulai = ($halaman > 1) ? ($halaman * $row) - $row         : 0;
            $tampil1 = mysqli_query($koneksi,$cari);
            $result = mysqli_num_rows($tampil1);
            $get_hal = ceil($result/$row);
            $no = $mulai + 1;
            $tampil2 = mysqli_query($koneksi,"SELECT * FROM detail_pembelian LIMIT $mulai, $row");
            if ($result == 0) {
              echo "<tr><td colspan=7>Tidak ada pembelian</td></tr>";
            }
            if (isset($_GET['cari'])) {
              $sql = $tampil1;
            }else {
              $sql = $tampil2;
            }
            while ($data = mysqli_fetch_assoc($sql)) {
              echo "<tr>
                      <td>".$no++."</td>
                      <td>".$data['id_akun']."</td>
                      <td>".$data['id_pembeli']."</td>
                      <td>".$data['id_buah']."</td>
                      <td>".$data['total_harga']."</td>
                      <td>".$data['tgl_beli']."</td>
              </tr>";
            }
          ?>
       </table>
      <center>
            <?php for ($i=1; $i <= $get_hal; $i++) { ?>
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
