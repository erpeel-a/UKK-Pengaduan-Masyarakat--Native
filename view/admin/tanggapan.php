<?php
session_start();
require '../../function.php';
$conn = DBConnection();
  //simpan session username
 $name = $_SESSION['username'];

    //cek sesi
  if(!isset($_SESSION['login'])){


    header('location:../../index.php');
    exit;
  }
  //id petugas
$_idPetugas = $_SESSION['id_petugas'];
$_idPengaduan = $_SESSION['idpengaduan'];
// var_dump($idPetugas);

// fech data pengadaun isi laporan
$sql = "SELECT isi_laporan FROM pengaduan WHERE id_pengaduan=$_idPengaduan";
$execute = mysqli_query($conn,$sql);
$pengaduan = mysqli_fetch_assoc($execute);


if(isset($_POST['submit'])){
  $tanggal = $_POST['tanggal'];
  $tanggapan = $_POST['tanggapan'];
  $tanggal = date('Y-m-d');
  // insert ke table tanggapan
  $sql = "INSERT INTO tanggapan(id_pengaduan,tgl_tanggapan,tanggapan,id_petugas) VALUES('$_idPengaduan','$tanggal','$tanggapan','$_idPetugas')";
  $execute_add_tanggapan = mysqli_query($conn, $sql); 
  $execute_update_pengaduan = mysqli_query($conn, "UPDATE pengaduan SET status ='selesai' WHERE id_pengaduan='$_idPengaduan'") or die(mysqli_error($conn));
  // update status tzable pengaduan;
  

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
<div class="container-fluid">
  <div class="row">
    <div  class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
      <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2>Tulis Tanggapan</h2>
      </div>
      <form action="" class="form " method="post" enctype="multipart/form-data">
        <div class="form-group">
          <label for="judul_pengaduan">Isi Pengaduan</label>
          <input type="text" readonly name="tanggal" class="form-control mb-3" value="<?= $pengaduan['isi_laporan'] ?>">
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
<?php require('../layouts/footer.php'); ?>