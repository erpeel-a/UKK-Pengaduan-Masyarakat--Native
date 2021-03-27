<?php
session_start();
require '../../function.php';
$conn = DBConnection();
if(!isset($_SESSION['login'])){
  header('location:../../index.php');
  exit;
}
$petugas = FetchAllData("SELECT * FROM petugas");
require('../layouts/header.php');
?>
<div class="container-fluid ">
  <div class="row justify-content-center">
    <div class="col-md-10 mt-4">
      <div class="card">
        <div class="card-header">Daftar Petugas</div>
        <div class="card-body">
          <table class="table table-bordered">
            <thead class="thead-dark">
              <tr>
                <th>Nama petugas</th>
                <th>Username</th>
                <th>No telp</th>
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
          <a href="index.php" class="btn btn-primary">kembali</a>
        </div>
      </div>
    </div>
  </div>
</div>
<?php require('../layouts/footer.php'); ?>