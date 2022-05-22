<?php
$host       = "localhost";
$user       = "root";
$pass       = "";
$db         = "absensi_perkuliahan";

$koneksi    = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) {       //cek koneksi
    die("Tidak dapat terhubung ke database!");
}
// else{
//     echo "Berhasil terhubung ke database!";
// }