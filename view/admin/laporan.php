<?php
session_start();
require('../../function.php');
$conn = DBConnection();
  if(!isset($_SESSION['login'])){
    header('location:login.php');
    exit;
  } 
  if($_SESSION['level'] != 'admin'){
    header('location:login.php');
  }
$pengaduan = FetchAllData("SELECT * FROM tanggapan INNER JOIN pengaduan ON tanggapan.id_pengaduan=pengaduan.id_pengaduan INNER JOIN petugas ON petugas.id_petugas=tanggapan.id_petugas")
?>
<?php require('../layouts/header.php')  ?>
<div class="container-fluid">
  <div class="row justify-content-center">
    <div class="col-md-10 mt-5">
      <div class="card">
        <div class="card-header">
          Cetak Laporan
        </div>
        <div class="card-body">
        <a href="generate_report.php" class="btn btn-primary my-2 float-right">Cetak </a>
          <div class="table-responsive">
          <table class="table table-bordered">
            <thead class="bg-dark text-white ">
              <tr>
                <th>Pengaduan</th>
                <th>tanggal pengaduan</th>
                <th>foto</th>
                <th>tgl_tanggapan</th>
                <th>Tanggapan</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($pengaduan as $data) : ?>
              <tr>
                <td><?= $data['isi_laporan'];?></td>
                <td><?= $data['tanggapan'];?></td>
                <td><img src="../../img/<?= $data['foto'] ;?>" width="200px" alt=""></td>
                <td><?= $data['tgl_pengaduan'];?></td>
                <td><?= $data['tanggapan'];?></td>
               
              </tr>
              <?php endforeach ;?>
            </tbody>
          </table>
          </div>
          <a href="index.php" class="btn btn-danger">kembali</a>
        </div>
      </div>
    </div>
  </div>
<?php require('../layouts/footer.php')  ?>
