<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Register</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
  <div class="topnav">
    <a href="index.php">Home</a>
    <a class="active" href="login.php">Login</a>
  </div>
    <div class="form-login">
        <form method="post">
            <h2 class="text">Register Form</h2>
                Username

                <input type="text" name="user" class="isi-form" required><br><br>
                Password

                <input type="text" name="pass" class="isi-form" required><br><br>
                Status

                <input type="text" name="status" value="agen" class="isi-form" readonly><br><br>
                <button type="submit" name="register" class="btn">Register</button> <br> <br>
                <button type="submit" onClick="window.location='login.php';" class="btn">Kembali</button> <br> <br>
        </form>
    </div>
</body>
</html>
<!-- -------------------------------------------- Action Register ------------------------------------------------ -->
<?php
    include('koneksi.php');
    if (isset($_POST['register'])) {
        $user = $_POST['user'];
        $pass = $_POST['pass'];
        $status = $_POST['status'];

        $register = mysqli_query($koneksi,"INSERT INTO tb_akun VALUES(NULL,'$user','$pass','$status')") or die (mysqli_error($koneksi));
        if ($register) {
            echo "<script>
                alert('Anda Berhasil Register');
                window.location='login.php';
            </script>";
        }
    }
?>
