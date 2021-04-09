<?php
session_start();
require '../../function.php'; //menyisipkan file function
require('../layouts/header.php'); // menyisipkan file layuot header.php
isLogin();
isMasyarakat();
?>
<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">
          Dashboard Home <div class="float-right">info user login <strong><?= $_SESSION['username'] ?></strong></div>
        </div>
        <div class="card-body">
          <a href="pengaduan_selesai.php" class="btn btn-primary">Daftar Pengaduan yang ditanggapi</a>
          <a href="input_pengaduan.php" class="btn btn-primary">Buat Laporan</a>
          <a href="../logout.php" class="btn btn-danger float-right">Logout</a>
        </div>
      </div>
    </div>
  </div>
</div>
<?php require('../layouts/footer.php'); // menyisipkan file layuot footer.php ?>