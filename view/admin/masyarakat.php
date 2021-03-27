<?php
session_start();
require '../../function.php';
$conn = DBConnection();
if(!isset($_SESSION['login'])){
  header('location:../../index.php');
  exit;
}
$masyarakat = FetchAllData("SELECT * FROM masyarakat");
require('../layouts/header.php');
?>
<div class="container-fluid ">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Daftar Masyarakat</h1>
      </div>
      <div class="container col-md-12">
        <table class="table table-bordered">
          <thead class="thead-dark">
            <tr>
              <th>Nik</th>
              <th>Nama</th>
              <th>Username</th>
              <th>telp</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($masyarakat as $data) : ;?>
            <tr>
              <td><?= $data['nik'];?></td>
              <td><?= $data['nama'];?></td>
              <td><?= $data['username'];?></td>
              <td><?= $data['telp'];?></td>
            </tr>
            <?php endforeach ;?>
          </tbody>
        </table>
        <a href="index.php" class="btn btn-primary">kembali</a>
      </div>
    </div>
  </div>
</div>
<?php require('../layouts/footer.php'); ?>