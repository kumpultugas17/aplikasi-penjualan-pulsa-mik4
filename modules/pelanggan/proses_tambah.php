<?php
require_once '../../config/config.php';
if (isset($_POST['submit'])) {
   $nama_pelanggan = $_POST['nama_pelanggan'];
   $no_hp = $_POST['no_hp'];

   $query = $conn->query("INSERT INTO pelanggan (nama_pelanggan, no_hp) VALUES ('$nama_pelanggan', '$no_hp')");

   if ($query) {
      session_start();
      $_SESSION['alert'] = 'Menambahkan pelanggan baru.';
   } else {
      session_start();
      $_SESSION['alert'] = 'Menambahkan pelanggan baru.';
   }
   header('location:../../index.php?module=pelanggan');
} else {
   header('location:../../index.php?module=pelanggan');
}
