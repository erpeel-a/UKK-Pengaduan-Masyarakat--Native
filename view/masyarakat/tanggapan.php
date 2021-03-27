<?php
session_start();
require '../../function.php';
$conn = DBConnection(); $name = $_SESSION['username'];
if(!isset($_SESSION['login'])){
  header('location:../../index.php');
  exit;
}
if($_SESSION['level'] != ''){
  header('location:login.php');
  exit;
}

$query = "SELECT * FROM tanggapan INNER JOIN pengaduan ON tanggapan.id_pengaduan=pengaduan.id_pengaduan INNER JOIN petugas ON petugas.id_petugas=tanggapan.id_petugas INNER JOIN masyarakat ON pengaduan.nik=masyarakat.nik";
$execute = mysqli_query($conn,$query) or die(mysqli_error($conn));
$FecthAllData = mysqli_fetch_All($execute,MYSQLI_ASSOC);

require('../layouts/header.php');
?>
<div class="container-fluid ">
  <div class="row justify-content-center">
    <main class="col-md-6">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Daftar Pengaduan :</h1>
      </div>
      <div class="container col-md-12">
      <table class="table table-bordered">
        <thead class="bg-dark text-white ">
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
        <tbody >
          <?php foreach($FecthAllData as $item) : 

            $status = $item['status'];
            if($status == '0'){
              $status = 'terkirim';
            }else if($status == 'proses'){
              $status = 'diproses';
            }else{
              $status = 'diterima';
            }

            $site_url = 'http://localhost/UKK-Pengaduan-Masyarakat--Native/';
            ?>
          <tr>
            <td><?= $item['nama'];?></td>
            <td><?= $item['tgl_pengaduan'];?></td>
            <td><?= $item['isi_laporan'];?></td>
            <td><img src="<?= $site_url ?>/img/<?= $item['foto'];?>"  width ="50px"alt=""></td>
            <td><?= $item['tanggapan'];?></td>
            <td><?= $item['tgl_tanggapan'];?></td>
            <td><?= $item['nama_petugas'] ?></td>
            <td><div class="badge badge-success"><?= $status ;?></div></td>
          </tr>
        <?php endforeach ;?>
        </tbody>
      </table>
      <a href="index.php" class="btn btn-primary">kembali</a>
    </div>
    </main>
  </div>
</div>
<?php require('../layouts/footer.php'); ?>
