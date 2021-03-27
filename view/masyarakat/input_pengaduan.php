<?php
require '../../function.php';
session_start();
if(!isset($_SESSION['login'])){
  header('location:../../index.php');
  exit;
}
if(isset($_POST['submit'])){
  $nik = $_SESSION['nik'];
  InputPengaduan($nik,$_POST);
}
require('../layouts/header.php');
?>
<div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col-md-6 mt-5">
      <div class="card">
        <div class="card-header">
          Buat pengaduan
        </div>
        <div class="card-body">
          <form action="" class="form-group" method="post" enctype="multipart/form-data">
            <label for="isi laporan">Isi Laporan</label>
            <textarea id="" cols="30" rows="10" name="isi" class="form-control" required></textarea>
            <label for="isi laporan">Foto pendukung</label>
            <input type="file" class="form-control mb-3" name="gambar" accept="image/*" required>
            <button type="submit" name="submit" class="btn btn-primary">
              Kirim Pengaduan
            </button>
            <a href="index.php" class="btn btn-danger float-right">kembali</a>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php require('../layouts/footer.php') ?>