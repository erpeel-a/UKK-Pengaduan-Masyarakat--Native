<?php
session_start();
require '../../function.php';
$conn = DBConnection();
  if(!isset($_SESSION['login'])){
    header('location:../../index.php');
    exit;
  }
$_idPetugas = $_SESSION['id_petugas'];
$_idPengaduan = $_SESSION['idpengaduan'];
$pengaduan = FetchAllData("SELECT isi_laporan FROM pengaduan WHERE id_pengaduan=$_idPengaduan");
if(isset($_POST['submit'])){
  $tanggal = $_POST['tanggal'];
  $tanggapan = $_POST['tanggapan'];
  $tanggal = date('Y-m-d');
  // insert ke table tanggapan
  $sql = "INSERT INTO tanggapan(id_pengaduan,tgl_tanggapan,tanggapan,id_petugas) VALUES('$_idPengaduan','$tanggal','$tanggapan','$_idPetugas')";
  $execute_add_tanggapan = mysqli_query($conn, $sql); 
  // update status pengaduan
  $execute_update_pengaduan = mysqli_query($conn, "UPDATE pengaduan SET status ='selesai' WHERE id_pengaduan='$_idPengaduan'") or die(mysqli_error($conn));
  // check if is_excetute
  if($execute_update_pengaduan && $execute_add_tanggapan){
    echo "<script>
    alert('Tanggapan Berhasil Dikkirim');
        window.location.href = 'pengaduan.php'
    </script>";
  }else{
    echo "
    <script>
     alert('tanggapan gagal dikitim');
    </script>
    ";
  }
}
require('../layouts/header.php');
?>
<div class="container">
  <div class="row">
    <div class="col-md-10 mt-5">
      <div class="card">
        <div class="card-header">Tulis Tanggapan</div>
        <div class="card-body">
          <form action="" class="form " method="post" enctype="multipart/form-data">
            <div class="form-group">
              <label for="judul_pengaduan">Isi Pengaduan</label>
              <input type="text" readonly name="tanggal" class="form-control mb-3"
                value="<?= $pengaduan[0]['isi_laporan'] ?>">
            </div>
            <div class="form-group">Tanggapan
              <label for="tanggapan"></label>
              <textarea name="tanggapan" id="" cols="30" rows="10" class="form-control"></textarea>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Kirim Tanggapan</button>
            <a href="index.php" class="btn btn-danger">Kembali</a>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php require('../layouts/footer.php'); ?>