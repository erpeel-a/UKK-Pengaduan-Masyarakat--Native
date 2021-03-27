<?php 
session_start();
require('../../function.php');
$conn = DBConnection();
  if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $check = mysqli_query($conn,"SELECT * FROM petugas WHERE username = '$username'");
    if(mysqli_num_rows($check) === 1){
      $data = mysqli_fetch_assoc($check);
        if($password == $data['password']){
          // create session
          $_SESSION['login'] =true;
          $_SESSION['username'] = $username;
          $_SESSION['password'] = $password;
          $_SESSION['id_petugas'] = $data['id_petugas'];
          $_SESSION['level'] = $data['level'];
          header('location:index.php');
        }
    }
    $error = true;
  }else if(isset($_POST['regist'])){
     header('location:../registrasi.php');
  }

require('../layouts/header.php')
?>
<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
    <?php if(isset($error)):?>
    <div class="alert alert-danger">username atau password anda salah</div>
    <?php endif ;?>
    <div class="card-header">Login <strong>Petugas</strong></div>
      <div class="card">
        <div class="card-body">
          <form class="form-group" method="post" action="">
            <div class="form-group">
              <label for="inputEmail" class="sr-only">username</label>
              <input type="text" id="inputEmail" class="form-control" placeholder="username" name="username" autofocus>
            </div>
            <div class="form-group">
              <label for="inputPassword" class="sr-only">Password</label>
              <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password">
            </div>
            <div class="form-group">
              <button class="btn btn-primary" type="submit" name="submit">Login</button>
              <a class="btn btn-danger float-right" href="../../index.php">Login Sebagai Masyarakat</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php require('../layouts/footer.php') ?>