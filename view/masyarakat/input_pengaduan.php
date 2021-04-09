<?php

session_start(); // mulai session
require('../../function.php'); // menyisipkan file funtion.php agar bisa digunakan fungsi2 yang ada di dalamnya
isLogin();
isMasyarakat();
if(isset($_POST['submit'])){ // check jika form sudah disubmit
  $nik = $_SESSION['nik']; // tanggap nik dari session dan masukkan ke variable $nik
  InputPengaduan($nik,$_POST); // jalankan fungsi InputPengaduan yang ada di file function.php dengan mengirimkan nik dan $_POST sebagai parameter 
  echo "<script>
        alert('Data pengaduan berhasil dikirim');
      </script>";
}
require('../layouts/header.php'); // menyisipkan file header.php
?>
<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-12">
    
      <div class="card">
      <div class="card-header">
        <h3>Buat pengaduan</h3>
      </div>
        <div class="card-body">
          <form action="" method="post" enctype="multipart/form-data">
            <label for="isi laporan">Isi Laporan</label>
            <textarea id="" cols="30" rows="10" name="isi" class="form-control" required></textarea> <br>
            <label for="isi laporan">Foto pendukung</label>
            <input type="file" name="gambar" accept="image/*" class="form-control"  required> <br>
            <button type="submit" name="submit" class="btn btn-primary">
              submit
            </button>
            <a href="index.php" class="btn btn-danger">kembali</a>
          </form>
        </div>
      </div>
     

    </div>
  </div>
</div>

<?php require('../layouts/footer.php')  // menyisipkan file footer.php?>