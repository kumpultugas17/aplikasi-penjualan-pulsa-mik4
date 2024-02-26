<?php
require_once '../../config/config.php';
if (isset($_POST['submit'])) {
   $nama_pengguna = $_POST['nama_pengguna'];
   $email = $_POST['email'];
   $password = $_POST['password'];
   $konfirmasi = $_POST['konfirmasi'];

   if ($password <> $konfirmasi) {
      session_start();
      $_SESSION['alert_konfirmasi'] = 'Password dan konfirmasi yang dimasukkan berbeda!';
      header('location:../../index.php?module=pengguna');
      exit;
   }

   $password = md5($password);

   $query = $conn->query("INSERT INTO pengguna (nama_pengguna, email, password) VALUES ('$nama_pengguna', '$email', '$password')");

   if ($query) {
      session_start();
      $_SESSION['alert'] = 'Menambahkan pengguna baru.';
   } else {
      session_start();
      $_SESSION['alert'] = 'Menambahkan pengguna baru.';
   }
   header('location:../../index.php?module=pengguna');
} else {
   header('location:../../index.php?module=pengguna');
}
