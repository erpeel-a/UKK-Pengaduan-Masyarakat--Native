<?php
session_start();
require '../../function.php';
$conn = DBConnection(); 
if(!isset($_SESSION['login'])){
  header('location:../../index.php');
  exit;
}
if($_SESSION['level'] != ''){
  header('location:login.php');
  exit;
}
$pengaduan = FetchAllData("SELECT * FROM tanggapan T1 INNER JOIN pengaduan P1 ON T1.id_pengaduan=P1.id_pengaduan INNER JOIN petugas P2 ON P2.id_petugas=T1.id_petugas INNER JOIN masyarakat M1 ON P1.nik=M1.nik");
require('../layouts/header.php');
?>
<div class="container-fluid ">
  <div class="row justify-content-center">
    <div class="col-md-10 mt-5">
      <div class="card">
        <div class="card-header">
          Daftar Pengaduan
        </div>
        <div class="card-body">
          <div class="table-reponsive">
            <table class="table table-bordered">
              <thead class="thead-dark">
                <tr>
                  <th>Nama Pelapor</th>
                  <th>Tanggal Pengaduan</th>
                  <th>isi laporan</th>
                  <th>bukti</th>
                  <th>tanggapan</th>
                  <th>tanggal tanggapan</th>
                  <th>Petugas</th>
                  <th>status</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($pengaduan as $item) : 
            $status = $item['status'];
            if($status == '0'){
              $status = 'Terkirim';
            }else if($status == 'proses'){
              $status = 'Sedang Diproses';
            }else{
              $status = 'Selesai';
            }
            ?>
                <tr>
                  <td><?= $item['nama'];?></td>
                  <td><?= $item['tgl_pengaduan'];?></td>
                  <td><?= $item['isi_laporan'];?></td>
                  <td><img src="<?= site_url ?>img/<?= $item['foto'];?>" width="50px" alt=""></td>
                  <td><?= $item['tanggapan'];?></td>
                  <td><?= $item['tgl_tanggapan'];?></td>
                  <td><?= $item['nama_petugas'] ?></td>
                  <td>
                    <div class="badge badge-success"><?= $status ;?></div>
                  </td>
                </tr>
                <?php endforeach ;?>
              </tbody>
            </table>
          </div>
          <a href="index.php" class="btn btn-primary">kembali</a>
        </div>
      </div>
    </div>
  </div>
</div>
<?php require('../layouts/footer.php'); ?>