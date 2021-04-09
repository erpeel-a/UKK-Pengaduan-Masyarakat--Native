<?php
session_start(); // memulai session
require '../../function.php'; // menyisipkan file function.php agar bisa digunakan function2nya
$conn = DBConnection(); // panggil function DBConnection dari file function.php
isLogin();// panggil fungsi isLogin yang ada di file functions.php
isPetugas(); 
  // tanggkap data petugas dengan fungsi FetchAllData yang sudah didefinisikan di function.php untuk mengambil data yang dikirimkan sebagai parameter dan masukkan dalam variable $petugas
$petugas = FetchAllData("SELECT * FROM petugas"); 
require('../layouts/header.php');
?>
<div class="container mt-5">
  <div class="row">
    <div class="col">
      <div class="card">
      <div class="card-header">
        <h2 class="text-center">Daftar Petugas</h2>
      </div>
        <div class="card-body">
          <table class="table table-bordered">
          <thead >
            <tr>
              <th>Nama Petugas</th>
              <th>username</th>
              <th>No Telp</th>
              <th>level</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($petugas as $data) : ;?>
            <tr>
              <td><?= $data['nama_petugas'];?></td>
              <td><?= $data['username'];?></td>
              <td><?= $data['telp'];?></td>
              <td><?= $data['level'];?></td>
            </tr>
            <?php endforeach ;?>
          </tbody>
            
          </table>
        </div>
      </div>
      <a href="index.php" class="my-5 btn btn-danger">kembali</a>
    </div>
  </div>
</div>
<?php require('../layouts/footer.php'); ?>