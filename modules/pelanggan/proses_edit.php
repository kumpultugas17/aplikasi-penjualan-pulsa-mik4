<?php
require_once '../../config/config.php';
if (isset($_POST['submit'])) {
   $id_pelanggan = $_POST['id_pelanggan'];
   $nama_pelanggan = $_POST['nama_pelanggan'];
   $no_hp = $_POST['no_hp'];

   $query = $conn->query("UPDATE pelanggan SET nama_pelanggan = '$nama_pelanggan', no_hp = '$no_hp' WHERE id_pelanggan = '$id_pelanggan'");

   if ($query) {
      session_start();
      $_SESSION['alert'] = 'Merubah data pelanggan.';
   } else {
      session_start();
      $_SESSION['alert'] = 'Merubah data pelanggan.';
   }
   header('location:../../index.php?module=pelanggan');
} else {
   header('location:../../index.php?module=pelanggan');
}
