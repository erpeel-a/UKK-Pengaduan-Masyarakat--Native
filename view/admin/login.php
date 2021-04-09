<?php 
session_start(); // memulai session
require '../../function.php'; // menyisipkan file function.php agar bisa digunakan function2nya
$conn = DBConnection(); // panggil function DBConnection dan masukkan ke dalam vaiable $conn
  if(isset($_POST['submit'])){ // check apakah form input sudah di submit
     // dapatkan data dari inputan form  berupa username dan password
    $username = $_POST['username'];
    $password = $_POST['password'];
    $check = mysqli_query($conn,"SELECT * FROM petugas WHERE username = '$username'"); // Query ke database
    if(mysqli_num_rows($check) === 1){ // check jika ada user yang ditermukan atau yang sesuai
      $data = mysqli_fetch_assoc($check); // ubah menjadi array assosiative
        if($password == $data['password']){ // check passwordnya
          // buat session
          $_SESSION['login'] =true;
          $_SESSION['username'] = $username;
          $_SESSION['password'] = $password;
          $_SESSION['id_petugas'] = $data['id_petugas'];
          $_SESSION['level'] = $data['level'];
          // alihkan ke index (yang ada dalam folder admin)
          header('location:index.php');
        }
    }
    $error = true;
  }
require('../layouts/header.php'); // menyisipkan file layout header 
?>
<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <?php if(isset($error)):?>
        <div class="alert alert-danger">kesalahan dalam input Password, silahkan coba lagi</div>
      <?php endif ;?>
      <div class="card">
      <div class="card-header">
          <div>Login <strong>Petugas</strong></div>
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
              <a href="<?= site_url ?>/view/masyarakat/login.php" class="float-right">Login Sebagai Masyarakat</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
  </div>
</form>
<?php require('../layouts/footer.php')  // menyisipkan file layout header  ?>