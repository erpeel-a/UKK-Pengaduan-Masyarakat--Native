<?php
session_start(); // memulai session
$_SESSION = []; // ubah session menjadi kosong
session_unset(); // agar tambah yakin tambahkan dengan meng-unset session
session_destroy(); // agar lebih yakin tambahkan dengan session_destroy()
header('location:../index.php'); // alihkan ke index page
?>