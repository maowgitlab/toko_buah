 <?php
 include('../koneksi.php');
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
            <button class="btnn" onClick="window.location='detail_pembelian.php';"><img src="../Icon/pie-chart-1.png" width=32 height=32><br><b>Detail Pembelian</b></button>
            <button class="btnn" onClick="window.location='../index.php';"><img src="../Icon/logout.png" width=32 height=32><br><b>Kembali</b></button>
        </div>
     </div>
     <div class="body">
       <div class="keuntungan">
         <?php
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
       <center><h3>Kelola Pesanan Buah / Barang</h3></center>
       <div class="pencarian">
         <form method="post">
           <input type="text" name="key" class="cari" placeholder="search..." required>
           <button type="submit" name="cari" class="btn-cari"><img src="../../Icon/cari.png" width=16 height=16></button>&nbsp;
         </form><br>
         <a href="index.php"><img src="../Icon/refresh.png" width=32 height=32></a><br>
       </div>
       <?php 
        include('../koneksi.php');
        $sql = mysqli_query($koneksi,"SELECT * FROM tb_buah");
        $result = mysqli_num_rows($sql);
        $dt = mysqli_fetch_assoc($sql);
       ?>
       <table border="1" cellpadding=4 cellspacing=0 width=95% align=center>
        <tr>
          <th>NO</th>
          <th>ID Buah</th>
          <th>Nama Buah</th>
          <th>Jumlah Beli</th>
          <th>Harga Satuan</th>
          <th>Nama Pelanggan</th>
          <th>ID Akun/Status</th>
          <th>Tanggal Beli</th>
          <th>Status</th>
          <?php if (isset($data['status'])) {
            echo "";
          }else {
            echo "<th>Konfirmasi ke admin</th>";
          }
          ?>
        </tr>
        <?php
            include('../koneksi.php');
            $a=$_SESSION['user'];
            if (isset($_POST['cari'])) {
              $key = $_POST['key'];
              $cari_data = "SELECT * FROM tb_buah WHERE nama_pelanggan='$a' AND nama_buah LIKE '%$key%'";
            }else {
              $cari_data = "SELECT * FROM tb_buah WHERE nama_pelanggan='$a'";
            }
            $row = 5;
            $halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
            $dimulai = ($halaman > 1) ? ($halaman * $row) - $row       : 0;
            $tampil1 = mysqli_query($koneksi,$cari_data);
            $tampil2 = mysqli_query($koneksi,"SELECT * FROM tb_buah WHERE nama_pelanggan='$a' ORDER BY id DESC LIMIT $dimulai, $row");
            $result  = mysqli_num_rows($tampil1);
            $per_hal = ceil($result/$row);
            $no = $dimulai+1;
            if ($result == 0) {
              echo "<tr><td colspan=10>Data Kosong</td></tr>";
            }else {
              if (isset($_POST['cari'])) {
                $tampil3 = $tampil1;
              }else {
                $tampil3 = $tampil2;
              }
              if (($_SESSION['user'])) {
                while ($data = mysqli_fetch_assoc($tampil3)) {
                  echo "<tr>
                            <td>".$no++."</td>
                            <td>".$data['id_buah']."</td>
                            <td>".$data['nama_buah']."</td>
                            <td>".$data['jumlah_beli']."</td>
                            <td>".$data['harga_satuan']."</td>
                            <td>".$data['nama_pelanggan']."</td>
                            <td>".$data['id_akun']."</td>
                            <td>".$data['tgl_beli']."</td>
                            <td>".$data['status']."</td>"?>
                            <?php if ($data['status']==null) {
                              echo "<td><a href='yes.php?id=".$data['id']."'";?>
                              onClick="return confirm('Konfirmasi Untuk Beli ?')"><img src='../Icon/add.png' width='32' height='32'</a>
                          <?php  }else{
                          echo "<td>Anda Sudah Konfirmasi</td>";?>
                        <?php  } ?>
                            
                  </tr><?php
                }
              }else {
                echo "<tr><td colspan=10>Data Kosong</td></tr>";
                
              }
            }
            ?>
       </table>
       <center>
         <?php for ($i=1; $i<=$per_hal; $i++) { ?>
           <a href="?halaman=<?php echo $i; ?>"><?php echo $i; ?></a>
        <?php } ?>
       </center>
     </div>
     <div class="footer">
       <center><h2>&copy;SMK Negeri 4 Banjarmasin</h2></center>
     </div>
     <!-- Close CSS -->
   </body>
 </html>

