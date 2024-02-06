<?php
require_once '../../config/config.php';
if (isset($_POST['submit'])) {
   $tanggal = $_POST['tanggal'];
   $pelanggan_id = $_POST['pelanggan'];
   $pulsa_id = $_POST['pulsa'];
   $harga = $_POST['harga'];

   $query = $conn->query("INSERT INTO penjualan (tanggal, pelanggan_id, pulsa_id, harga) VALUES ('$tanggal', '$pelanggan_id', '$pulsa_id', '$harga_jual')");

   if ($query) {
      session_start();
      $_SESSION['alert'] = 'Melakukan transaksi baru.';
   } else {
      session_start();
      $_SESSION['alert'] = 'Melakukan transaksi.';
   }
   header('location:../../index.php?module=penjualan');
} else {
   header('location:../../index.php?module=penjualan');
}
