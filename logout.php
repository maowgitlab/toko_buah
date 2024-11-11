<?php
  session_start();
  session_destroy();
  echo "<script>
    alert('Anda Logout...');
    window.location='login.php';
  </script>";
 ?>
