<?php
  session_start();
  if (isset($_SESSION['status'])) {
    echo "<script>
      alert('Anda Masih Login, Silahkan Logout Terlebih Dahulu');
      window.location='Owner/index.php';
    </script>";
  }
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
  <div class="topnav">
    <a href="index.php">Home</a>
    <?php 
          if (isset($_SESSION['status'])) {
            echo "<a class='active' href='logout.php'>Logout</a>";
          }else {
            echo "<a class='active' href='login.php'>Login</a>";
          }
        ?>
    <!-- <a class="active" href="login.php">Login</a> -->
  </div>
    <div class="form-login">
        <form method="post">
            <h2 class="text">Login Form</h2>
                Username

                <input type="text" name="user" class="isi-form" required><br><br>
                Password

                <input type="password" name="pass" class="isi-form" required><br><br>
                <button type="submit" name="login" class="btn">Login</button> <br> <br>
                <button type="submit" onCLick="window.location='register.php';" class="btn">Register</button>
        </form>
    </div>
</body>
</html>
<!-- -------------------------------------------- Action Login ------------------------------------------------ -->
<?php
    include('koneksi.php');
    if (isset($_POST['login'])) {
        $user = $_POST['user'];
        $pass = $_POST['pass'];

        $periksa = mysqli_query($koneksi,"SELECT * FROM tb_akun WHERE username='$user' AND password='$pass'");
        $data = mysqli_num_rows($periksa);
        if ($data > 0) {
            $data2 = mysqli_fetch_assoc($periksa);
            if ($data2['status']=="owner") {
                $_SESSION['user'] = $data2['username'];
                $_SESSION['status'] = $data2['status'];
                echo "<script>
                    alert('Anda Login, Selamat Datang Owner');
                    window.location='Owner/index.php';
                </script>";
            }elseif ($data2['status']=="agen") {
              $_SESSION['user'] = $data2['username'];
              $_SESSION['status'] = $data2['status'];
              if ($_GET['id']) {
                $jml_beli = $_GET['jumlah'];
                $total = $_GET['total'];
                echo "<script>
                alert('Anda Login, Selamat Datang Agen...');
                window.location='jual_buah.php?id=".$_GET['id']."&jumlah=".$jml_beli."&total=".$total."';
              </script>";
              }else {
                echo "<script>
                alert('Anda Login, Selamat Datang Agen...');
                window.location='index.php';
              </script>";
              }
            }
        }else {
          echo "<script>
            alert('Gagal Login');
            window.location='login.php';
          </script>";
        }
    }
?>
