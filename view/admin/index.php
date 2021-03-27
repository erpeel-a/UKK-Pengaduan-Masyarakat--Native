
<?php
  session_start();
  if(!isset($_SESSION['login'])){
    header('location:../../index.php');
    exit;
  }
 require('../layouts/header.php');
 ?>
<div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col-md-6 mt-5">
      <div class="card">
          <div class="card-header">
            Dashboard
          </div>
        <div class="card-body">
          <div class="container">
            <div class="row">
              <div class="col">
              <p>Info user login : <b><?= $_SESSION['username'];?></b></p>
              <?php if($_SESSION['level'] === 'admin') {?>
                <a href="registrasi.php" class="btn btn-primary">Registrasi Petugas</a>
                <a href="laporan.php" class="btn btn-primary">Cetak laporan </a>
              <?php } ?>
                <a href="masyarakat.php" class="btn btn-primary">Data Masyarakat</a>
                <a href="petugas.php" class="btn btn-primary">Data Petugas</a>
                <a href="pengaduan.php" class="btn btn-primary">Data Pengaduan</a>
                <a href="../logout.php" class="btn btn-danger my-2">Logout</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php require('../layouts/footer.php') ?>