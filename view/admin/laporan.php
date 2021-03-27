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
$pengaduan = FetchAllData("SELECT *  FROM tanggapan T1 INNER JOIN pengaduan P1 ON T1.id_pengaduan=P1.id_pengaduan INNER JOIN petugas P2 ON P2.id_petugas=T1.id_petugas")
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
                  <td><?= $data['tgl_pengaduan'];?></td>
                  <td><img src="<?= site_url ?>/img/<?= $data['foto'] ;?>" width="200px" alt=""></td>
                  <td><?= $data['tgl_tanggapan'];?></td>
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