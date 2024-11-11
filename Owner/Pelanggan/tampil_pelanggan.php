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
            <button class="btnn" onClick="window.location='tampil_pelanggan.php';"><img src="../../Icon/pelanggan.png" width=32 height=32><br><b>Data Pelanggan</b></button>
            <button class="btnn" onClick="window.location='../../logout.php';"><img src="../../Icon/logout.png" width=32 height=32><br><b>Logout</b></button>
        </div>
     </div>
     <div class="body">
       <center><h3>Data Pelanggan/Pembeli</h3></center>
       <div class="test" style="display:flex;align-items:center;">
         <div class="pencarian">
           <form method="get">
             <input type="text" name="key" class="cari" placeholder="search..." required>
             <button type="submit" name="cari" class="btn-cari"><img src="../../Icon/cari.png" width=16 height=16></button>&nbsp;
           </form>
         </div>
         <a href="tampil_pelanggan.php"><img src="../../Icon/refresh.png" width=32 height=32></a><br>
       </div>
       <?php 
        include('../../koneksi.php');
        $sql = mysqli_query($koneksi,"SELECT * FROM tb_pelanggan");
        $result = mysqli_num_rows($sql);
        if ($result == 0) {
          echo "";
        }else {
          echo "<a class='btn-cetak' href='cetak_pelanggan.php'>Cetak Data</a><br><br>";
        }
       ?>
       <a class="btn-add" href="tambah_pelanggan.php">Tambah Pelanggan</a><br><br>
       <table border="1" cellpadding=4 cellspacing=0 width=95% align=center>
         <tr>
           <th>No</th>
           <th>ID Pelanggan</th>
           <th>Nama Pelanggan</th>
           <th>Jenis Kelamin</th>
           <th>Nomer Hp</th>
           <th>Tanggal Beli</th>
           <th>Opsi</th>
         </tr>
         <?php
            include('../../koneksi.php');
            if (isset($_GET['cari'])) {
              $key = $_GET['key'];
              $cari = "SELECT * FROM tb_pelanggan WHERE id_pelanggan LIKE '%$key%' OR
                        nama_pelanggan LIKE '%$key'";
            }else {
              $cari = "SELECT * FROM tb_pelanggan";
            }
            $row = 5;
            $halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
            $mulai = ($halaman > 1) ? ($halaman * $row) - $row         : 0;
            $no = $mulai + 1;
            $tampil1 = mysqli_query($koneksi,$cari);
            $result = mysqli_num_rows($tampil1);
            $get_hal = ceil($result/$row);
            $tampil2 = mysqli_query($koneksi,"SELECT * FROM tb_pelanggan LIMIT $mulai,$row");
            if ($result == 0) {
              echo "<tr><td colspan=7>Data Pelanggan Kosong </td></tr>";
            }else {
              if (isset($_GET['cari'])) {
                $sql = $tampil1;
              }else {
                $sql = $tampil2;
              }
              while ($data = mysqli_fetch_assoc($sql)) {
                if ($data['jenkel']=="L") {
                  $jenkel = "Laki-Laki";
                }else {
                  $jenkel = "Perempuan";
                }
                echo "<tr>
                        <td>".$no++."</td>
                        <td>".$data['id_pelanggan']."</td>
                        <td>".$data['nama_pelanggan']."</td>
                        <td>".$jenkel."</td>
                        <td>".$data['no_hp']."</td>
                        <td>".$data['tgl_beli']."</td>
                        <td><a class='btn-link' href='ubah_pelanggan.php?id=".$data['id_pelanggan']."'><img src='../../Icon/edit.png' width=32 height=32</a>
                            <a href='hapus_pelanggan.php?id=".$data['id_pelanggan']."'";?>
                              onCLick="return confirm('Mau Hapus Data Pelanggan ini ?')"><img src='../../Icon/hapus.png' width=32 height=32</a></td>
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
