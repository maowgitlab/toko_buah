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
            <button class="btnn" onClick="window.location='tampil_buah.php';"><img src="../../Icon/price-tag-4.png" width=32 height=32><br><b>Kelola Buah</b></button>
            <button class="btnn" onClick="window.location='../Stok/tampil_stok.php';"><img src="../../Icon/cart-14.png" width=32 height=32><br><b>Stok Buah</b></button>
            <button class="btnn" onClick="window.location='../detail_pembelian.php';"><img src="../../Icon/pie-chart-1.png" width=32 height=32><br><b>Detail Pembelian</b></button>
            <button class="btnn" onClick="window.location='../Akun/tampil_akun.php';"><img src="../../Icon/agen.png" width=32 height=32><br><b>Kelola Agen</b></button>
            <button class="btnn" onClick="window.location='../Pelanggan/tampil_pelanggan.php';"><img src="../../Icon/pelanggan.png" width=32 height=32><br><b>Data Pelanggan</b></button>
            <button class="btnn" onClick="window.location='../../logout.php';"><img src="../../Icon/logout.png" width=32 height=32><br><b>Logout</b></button>
        </div>
     </div>
     <div class="body">
       <!-- ------------ Tampil Data Paging, Pencarian -------------- -->

       <center><h3>Kelola Data Buah</h3></center>
       <div class="pencarian">
         <form method="post">
           <input type="text" name="key" class="cari" placeholder="search..." required>
           <button type="submit" name="cari" class="btn-cari"><img src="../../Icon/cari.png" width=16 height=16></button>&nbsp;
         </form><br>
         <a href="tampil_buah.php"><img src="../../Icon/refresh.png" width=32 height=32></a><br>
       </div>
       <?php 
        include('../../koneksi.php');
        $sql = mysqli_query($koneksi,"SELECT * FROM tb_buah");
        $result = mysqli_num_rows($sql);
        if ($result == 0) {
          echo "";
        }else {
          echo "<a class='btn-cetak' href='cetak_buah.php'>Cetak Data</a><br><br>";
        }
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
          <th>Konfirmasi Ke Agen / Pelanggan</th>
        </tr>
        <?php
            include('../../koneksi.php');
            if (isset($_POST['cari'])) {
              $key = $_POST['key'];
              $cari_data = "SELECT * FROM tb_buah WHERE nama_buah LIKE '%$key%'";
            }else {
              $cari_data = "SELECT * FROM tb_buah";
            }
            $row = 5;
            $halaman = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
            $dimulai = ($halaman > 1) ? ($halaman * $row) - $row       : 0;
            $tampil1 = mysqli_query($koneksi,$cari_data);
            $result  = mysqli_num_rows($tampil1);
            $per_hal = ceil($result/$row);
            $tampil2 = mysqli_query($koneksi,"SELECT * FROM tb_buah ORDER BY id DESC LIMIT $dimulai, $row");
            $no = $dimulai+1;
            if ($result == 0) {
              echo "<tr><td colspan=11>Data Kosong</td></tr>";
            }else {
              if (isset($_POST['cari'])) {
                $tampil3 = $tampil1;
              }else {
                $tampil3 = $tampil2;
              }
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
                          <td>".$data['status']."</td>
                          <td>";?>
                          <?php 
                           if ($data['status']=="Barang / buah telah dikirim" || $data['status']=="Ditolak") {
                           echo "<a href='hapus_buah.php?id=".$data['id']."'";?>
                           onClick="return confirm('Hapus Pembelian Ini ?')"><img src="../../Icon/delete.png" width="32" height="32"</a></a>
                           </td>
                          <?php  }elseif ($data['status']) {
                            echo "<a href='yes.php?id=".$data['id']."&akun=".$data['id_akun']."&pembeli=".$data['nama_pelanggan']."&buah=".$data['nama_buah']."&total_harga=".$data['total_harga']."&tgl=".$data['tgl_beli']."'";?>
                            onClick="return confirm('Konfirmasi Ke agen ?')"><img src='../../Icon/add.png' width='32' height='32'</a></a> |

                            <a href='no.php?id=<?php echo $data['id'];?>&id_buah=<?php echo $data['id_buah']; ?>&stok=<?php echo $data['jumlah_stok']; ?>'
                              onClick="return confirm('Batalkan Pembelian Ini ?')"><img src="../../Icon/hapus.png" width="32" height="32"</a>
                        <?php  } ?>
                </tr><?php
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
