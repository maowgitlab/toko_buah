<?php 
include('koneksi.php'); 
session_start();
?>
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
      <div class="form">
         <?php
            include('koneksi.php');
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
           <input type="number" name="beli" id="beli" value="<?php if(isset($_GET['jumlah'])){ echo $_GET['jumlah'];} ?>" class="form-number" onkeyup="hitung();">
           Harga Satuan
           <input type="number" name="satuan" id="satuan" class="form-number" value="<?php echo $data['harga_awal']; ?>" readonly style="background-color: rgb(161, 159, 158); font-weight: bold;">
           Total Harga
           <input type="number" name="total" id="total" value="<?php if(isset($_GET['total'])){ echo $_GET['total'];} ?>" class="form-number" readonly style="background-color: rgb(161, 159, 158); font-weight: bold;">
           <?php
              if (isset($_SESSION['status'])) { 
                echo "Status
                      <input type='text' name='status' class='form-text' value=".$_SESSION['status']." readonly style='background-color: rgb(161, 159, 158); font-weight: bold;'>";
              }else{
                echo "";
            } ?>
            <?php
              if (isset($_SESSION['status'])) { 
                echo "Nama
                <input type='text' name='user' class='form-text' value=".$_SESSION['user']." readonly style='background-color: rgb(161, 159, 158); font-weight: bold;'>";
              }else{
                echo "";
            } ?>
           
            <!-- tgl_beli -->
            <input type="hidden" name="tgl" value="<?php echo date('Y-m-d H:i:s'); ?>" class="form-text">
           <input type="submit" name="tambah" value="Tambah" class="btn-tambah">
         </form>
       </div>
     </div>
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
<?php
    if (isset($_SESSION['status'])) {
      if (isset($_POST['beli'])) {
        $nama = $_POST['nama'];
        $stok = $_POST['stok'];
        $jml_beli = $_POST['beli'];
        $satuan = $_POST['satuan'];
        $total = $_POST['total'];
        $user = $_POST['user'];
        $status = $_POST['status'];
        $tgl = $_POST['tgl'];
        if ($jml_beli>$stok) {
          echo "<script>
            alert('Upps Jumlah beli melebihi stok');
            window.location='index.php';
          </script>";
        }else if($jml_beli<=$stok){
          $tambah = mysqli_query($koneksi,"INSERT INTO tb_buah VALUES(NULL,'$id','$nama','$jml_beli','$satuan','$stok','$user','$status','$tgl','$total','')") or die (mysqli_error($koneksi));
          $update = mysqli_query($koneksi,"UPDATE stok_buah SET jumlah_stok=$stok-$jml_beli WHERE stok_buah.id_buah='$id'") or die (mysqli_error($koneksi));
        }
        if ($tambah) {
          echo "<script>
            alert('Buah sudah dibuat ke keranjang, Silahkan cek dasbord untuk konfirmasi');
            window.location='index.php';
          </script>";
        }else {
          echo "<script>
            alert('Buah Gagal Dibeli');
            window.location='jual_buah.php';
          </script>";
        }
      }
    }elseif (isset($_POST['beli'])) {
      $jml_beli = $_POST['beli'];
      $total = $_POST['total'];
      echo "<script>
      alert('Untuk Membeli Buah atau Barang ini Anda bisa Login sebagai Agen / menjadi pelanggan kami, Jika ingin Berlangganan di Toko Kami Anda bisa Hubungi Owner TerimaKasih...');
      window.location='login.php?id=".$_GET['id']."&jumlah=".$jml_beli."&total=".$total."';
      </script>";
    }
?>