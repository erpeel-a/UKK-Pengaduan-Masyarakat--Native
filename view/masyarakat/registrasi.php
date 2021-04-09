<?php
require '../../function.php'; // menyisipkan file function.php agar bisa digunakan function2nya
$conn = DBConnection(); // panggil function DBConnection dan masukkan ke dalam vaiable $conn
if(isset($_POST['submit'])){ // chek apakah form sudah di submit
  if(MasyarakatRegister($_POST) > 0 ){ // masukkan data dari $_POST ke fungsi MasyarakatRegister (yang ada di file function) dan check jika data masuk / lebih dari 0
    echo "<script>
        alert('Registrasi berhasil');
      </script>";
  }else{
    echo mysqli_error($conn); // jika error tampilkan error
  }
}
require('../layouts/header.php'); // menyisipkan file header.php
?>
<div class="container mt-5">
  <div class="row">
    <div class="col-md-10">
      <div class="card">
        <div class="card-header">
          Registrasi Masyarakat
        </div>
        <div class="card-body">
          <form method="post" action="">
            <div class="form-group">
              <label for="nama">nama</label>
              <input type="text" id="nama" class="form-control" placeholder="nama" name="nama" required autofocus> 
            </div>
            <div class="form-group">
              <label for="username">username</label>
              <input type="text" id="username" class="form-control" placeholder="username." required name="username"
                autofocus> 
            </div>
            <div class="form-group">

              <label for="nik">nik</label>
              <input type="number" id="nama" class="form-control" placeholder="xxxxx" name="nik" required autofocus>
            </div>
            <div class="form-group">
              <label for="telephone">telp</label>
              <input type="number" id="telephone" class="form-control" placeholder="08xxxxxxx" required name="telephone"
                autofocus>
            </div>
            <div class="form-group">
            </div>
            <div class="form-group">
              <label for="inputPassword">Password</label>
              <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password"
                required>
              <label for="inputPassword">Password</label>
              <input type="password" id="inputPassword agin" class="form-control" placeholder="Password"
                name="konfirmasi_password" required>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Registrasi</button>
            <a href="<?= site_url ?>/index.php" class="btn btn-danger">kembali</a>
          </form>
        </div>
      </div>

    </div>
  </div>
</div>

<?php require('../layouts/footer.php'); // menyisipkan file footer.php ?>