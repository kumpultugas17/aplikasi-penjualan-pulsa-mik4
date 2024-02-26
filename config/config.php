<?php
// set timezone
date_default_timezone_set("ASIA/JAKARTA");
// koneksi database
require_once "koneksi.php";

// pelanggan
$pelanggan = $conn->query("SELECT COUNT(id_pelanggan) as pelanggan FROM pelanggan");
$data_pelanggan = mysqli_fetch_assoc($pelanggan);
$get_pelanggan = $data_pelanggan['pelanggan'];

// pulsa
$pulsa = $conn->query("SELECT COUNT(id_pulsa) as pulsa FROM pulsa");
$data_pulsa = mysqli_fetch_assoc($pulsa);
$get_pulsa = $data_pulsa['pulsa'];

// penjualan
$penjualan = $conn->query("SELECT COUNT(id_penjualan) as penjualan FROM penjualan");
$data_penjualan = mysqli_fetch_assoc($penjualan);
$get_penjualan = $data_penjualan['penjualan'];

// total penjualan
$total_harga = $conn->query("SELECT SUM(harga) as harga FROM penjualan");
$data_harga = mysqli_fetch_assoc($total_harga);
$get_harga = $data_harga['harga'];

// format tanggal indonesia
function tanggal_indonesia($tanggal)
{
   $bulan = array(
      1 =>   'Januari',
      'Februari',
      'Maret',
      'April',
      'Mei',
      'Juni',
      'Juli',
      'Agustus',
      'September',
      'Oktober',
      'November',
      'Desember'
   );

   $pecahkan = explode('-', $tanggal);

   // variabel pecahkan 0 = tahun
   // variabel pecahkan 1 = bulan
   // variabel pecahkan 2 = tanggal

   return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
}
