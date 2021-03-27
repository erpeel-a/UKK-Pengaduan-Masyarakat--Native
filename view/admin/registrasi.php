<?php
require '../../function.php';
if(isset($_POST['submit'])){
  if(PetugasRegister($_POST) > 0){
    echo "<script>
      alert('Data Petugas Berhasil ditambahkan ke database');
    </script>";
  }else{
    echo mysqli_error($conn);
  }
}
?>
<?php require('../layouts/header.php') ?>
  <div class="container mt-5">
    <div class="row  justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            Registrasi Petugas
          </div>
          <div class="card-body">
            <form class="form-group" method="post" action="">
              <div class="form-group">
                <label for="nama" class="sr-only">nama petugas</label>
                <input type="text" id="nama" class="form-control" placeholder="nama petugas" required name="namapetugas"
                  autofocus>
              </div>
              <div class="form-group">
                <label for="username" class="sr-only">username</label>
                <input type="text" id="username" class="form-control" placeholder="username" required name="username"
                  autofocus>
              </div>
              <div class="form-group">
                <label for="telephone" class="sr-only">Telephone</label>
                <input type="text" id="telephone" class="form-control" placeholder="08xxxxxxxx." required
                  name="telephone" autofocus>
              </div>
              <div class="form-group">
                <select name="level" id="" class="form-control">
                  <option value="admin">admin</option>
                  <option value="petugas">petugas</option>
                </select>
              </div>
              <div class="form-group">
                <label for="inputPassword" class="sr-only">Password</label>
                <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password"
                  required>
              </div>
              <div class="form-group">
                <label for="inputPassword" class="sr-only">Konfirmasi Pasword</label>
                <input type="password" id="inputPassword" class="form-control" placeholder="Konfirmasi Password"
                  name="konfirmasi_password" required>
              </div>
              <button class="btn btn-primary" type="submit" name="submit">Register</button>
              <a class="btn btn-danger" href="index.php">kembali</a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php require('../layouts/footer.php') ?>