<?php
session_start();
require('../../function.php');
$conn = DBConnection();
if(!isset($_SESSION['login'])){
  header('location:../../index.php');
  exit;
}
if(isset($_POST['verify'])){
  $idpengaduan = $_POST['verify'];
  $_SESSION['idpengaduan'] = $idpengaduan;
  $cek = mysqli_query($conn, "UPDATE pengaduan SET status ='proses' WHERE id_pengaduan='$idpengaduan'") or die(mysqli_error($conn));
  header('location:tanggapan.php');
}
$pengaduan = FetchAllData("SELECT * FROM pengaduan");
require('../layouts/header.php');
?>
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10 mt-5">
      <div class="card">
        <div class="card-header">Daftar Pengaduan</div>
        <div class="card-body">
          <table class="table table-bordered">
            <thead class="bg-dark text-white ">
              <tr>
                <th>tanggal</th>
                <th>isi laporan</th>
                <th>bukti</th>
                <th>status</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($pengaduan as $data) :
             $status = $data['status'];
             if($status == '0'){
               $status = 'Terkirim';
             }else if($status == 'proses'){
               $status = 'Diproses';
             }else{
               $status = 'Selesai';
             }
 
            ?>
              <tr>
                <td><?= $data['tgl_pengaduan'];?></td>
                <td><?= $data['isi_laporan'];?></td>
                <td><img src="<?= site_url ?>img/<?= $data['foto'];?>" width="50px" alt=""></td>
                <td>
                  <div class="badge badge-success"><?= $status ;?></div>
                </td>
                <td>
                  <form action="" method="post">
                    <button value="<?= $data['id_pengaduan'] ;?>" type="submit" class="btn btn-sm btn-primary"
                      name="verify">Verifikasi Data</button>
                  </form>
                </td>
              </tr>
              <?php endforeach ;?>
            </tbody>
          </table>
          <a href="index.php" class="btn btn-danger">kembali</a>
        </div>
      </div>
    </div>
  </div>
</div>
<?php require('../layouts/footer.php'); ?>