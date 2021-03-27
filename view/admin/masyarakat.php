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
<div class="container ">
  <div class="row justify-content-center">
    <div class="col-md-10 mt-5">
      <div class="card">
        <div class="card-header">
            Daftar Masyarakat
        </div>
        <div class="card-body">
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
</div>
<?php require('../layouts/footer.php'); ?>