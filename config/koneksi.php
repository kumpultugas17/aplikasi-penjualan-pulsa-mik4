<?php
$conn = mysqli_connect("localhost", "root", "", "db_penjualan_pulsa_mik4");

// check connection
if (mysqli_connect_errno()) {
   echo "Failed to connect Database: " . mysqli_connect_error();
   exit();
}
