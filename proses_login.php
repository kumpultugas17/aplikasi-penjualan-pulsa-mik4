<?php
require_once 'config/config.php';
if (isset($_POST['submit'])) {
   $email = $_POST['email'];
   $password = md5($_POST['password']);

   $query = $conn->query("SELECT * FROM pengguna WHERE email = '$email' AND password = '$password'");
   $result = mysqli_num_rows($query);
   $data = mysqli_fetch_assoc($query);
   if ($result > 0) {
      session_start();
      $_SESSION['login'] = true;
      $_SESSION['nama'] = $data['nama_pengguna'];
      header('location:index.php?module=beranda');
   } else {
      session_start();
      $_SESSION['error_login'] = 'Silahkan masukkan E-Mail dan Password yang benar!';
      header('location:login.php');
   }
} else {
   header('location:login.php');
}
