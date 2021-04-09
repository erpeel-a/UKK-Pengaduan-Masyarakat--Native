<?php 

session_start(); // mulai session
require('../../function.php'); // menyisipkan fle function.php
$conn = DBConnection(); // memanggil fungsi DBConnection dari file function.php

  if(isset($_POST['submit'])){ // cck jika tombol login sudah di submit
    //dapatkan data dari inputan form  berupa username dan password
    $username = $_POST['username'];
    $password = $_POST['password'];
    // query ke database
    $check = mysqli_query($conn,"SELECT * FROM masyarakat WHERE username = '$username'") or die (mysqli_error($conn));
    //cek username
    if(mysqli_num_rows($check) === 1){ 
      $data = mysqli_fetch_assoc($check);
        if($password == $data['password']){
          // create session
          $_SESSION['login'] = true;
          $_SESSION['nik'] = $data['nik'];
          $_SESSION['username'] = $data['username'];  
          $_SESSION['level'] ='masyarakat';  
          header('location:index.php');
          exit;
        }
    }
    // error
    $error = true;

  }
  require('../layouts/header.php');
?>
<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <?php if(isset($error)):?>
      <div class="alert alert-danger">kesalahan dalam input Password, silahkan coba lagi</div>
      <?php endif ;?>
      <div class="card">
      <div class="card-header">
          <div>Login <strong>Masyarakat</strong></div>
      </div>
        <div class="card-body">
          <form method="post" action="" class="form-group">
            <div class="form-group">
              <label for="inputEmail">username</label>
              <input type="text" id="inputEmail" class="form-control" placeholder="username" name="username" autofocus>
            </div>
            <div class="form-group">
              <label for="inputEmail">Password</label>
              <input type="password" id="inputEmail" class="form-control" placeholder="password" name="password" autofocus>
            </div>
           
            <div>
              <button type="submit" class="btn btn-primary" name="submit">Login</button>
              <a href="<?= site_url ?>/view/masyarakat/registrasi.php" class="btn btn-success">Registrasi</a>
              <a href="<?= site_url ?>/view/admin/login.php" class="float-right">Login Sebagai Petugas</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php require('../layouts/footer.php') ?>