<?php
require '../../function.php';
$conn = DBConnection();
if(isset($_POST['submit'])){
  if(MasyarakatRegister($_POST) > 0 ){
      header('Location:../../login.php');
  }else{
    echo mysqli_error($conn);
  }
}
require('../layouts/header.php');
?>

<div class="container">
  <div class="row">
    <div class="col-md-10 mt-3">
      <div class="card">
        <div class="card-header">Registrasi Masyarakat</div>
        <div class="card-body">
          <form class="form-group" method="post" action="">
            <div class="form-group">
              <label for="nama" class="sr-only">nama</label>
              <input type="text" id="nama" class="form-control" placeholder="nama" name="nama" required autofocus>
            </div>
            <div class="form-group">
              <label for="username" class="sr-only">username</label>
              <input type="text" id="username" class="form-control" placeholder="username." required name="username"
                autofocus>
            </div>
            <div class="form-group">
              <label for="nik" class="sr-only">nik</label>
              <input type="number" id="nama" class="form-control" placeholder="NIK" name="nik" required autofocus>
          
            <div class="form-group">
              <label for="telephone" class="sr-only">telp</label>
              <input type="number" id="telephone" class="form-control" placeholder="08xxxxxxx" required name="telephone"
                autofocus>
            </div>
            <div class="form-group">
              <label for="inputPassword" class="sr-only">Password</label>
              <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password"
                required>
            </div>
            <div class="form-group">
              <label for="inputPassword" class="sr-only">Password</label>
              <input type="password" id="inputPassword agin" class="form-control" placeholder="konfirmasi_password"
                name="konfirmasi_password" required>
            </div>
            <button class="btn  btn-primary" type="submit" name="submit">Registrasi</button>
            <a href="<?= site_url ?>" class="btn btn-danger float-right">Sudah punya akun</a>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php require('../layouts/footer.php'); ?>
