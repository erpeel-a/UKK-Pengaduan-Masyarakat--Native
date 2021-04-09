<?php
  session_start(); // mulai session
   require('../layouts/header.php');  //menyisipkan layout header 
   require '../../function.php'; // menyisipkan file function.php agar bisa di pakai function2 yang ada didalamnya
   isLogin();// panggil fungsi isLogin yang ada di file functions.php
   isPetugas(); //untuk mengecek apakah user dari table petugas yang login
 ?>
<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">
          Dashboard Home <div class="float-right">info user login <strong><?= $_SESSION['username'] ?></strong></div>
        </div>
        <div class="card-body">
          <!-- menu yang akan ditampilkan jika admin yang login -->
          <?php if($_SESSION['level'] === 'admin') {?>
          <a href="registrasi.php" class="btn btn-primary my-2">Registrasi Petugas</a>
          <a href="laporan.php" class="btn btn-primary my-2">Cetak laporan </a>
          <?php }?>
          <a href="pengaduan_selesai.php" class="btn btn-primary my-2">Data Pengaduan Yang Ditanggapi</a>
          <a href="petugas.php" class="btn btn-primary my-2">Data Petugas</a>
          <a href="Masyarakat.php" class="btn btn-primary my-2">Data Masyarakat</a>
          <a href="pengaduan.php" class="btn btn-primary my-2">Data Pengaduan</a>
          <a href="../logout.php" class="btn btn-danger my-2">Logout</a>

        </div>
      </div>
    </div>
  </div>
</div>

<?php require('../layouts/footer.php') ?>