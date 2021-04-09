<?php
require '../../function.php'; // menyisipkan file function.php agar bisa di pakai function2 yang ada didalamnya
if(isset($_POST['submit'])){ // check jika tombol form sudah disubmit
  if(PetugasRegister($_POST) > 0){ // masukkan data input ke fungsi PetugasRegister dari file function.php dan check jika data yang masuk tidak 0 / lebih dari 0
    echo "<script>
      alert('Registrasi berhasil');
    </script>";
    // maka munculkan alert
  }else{
    // maka munculkan error dari koneksi
    echo mysqli_error($conn);
  }
}
require('../layouts/header.php') // menyisipkan file layout header
?>

<div class="container mt-4">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h2 class="text-center">Registrasi</h2>
        </div>
        <div class="card-body">
          <form method="post" action="">
            <div class="form-group">
              <label for="nama">nama petugas</label>
              <input type="text" id="nama" class="form-control" placeholder="nama petugas" required name="namapetugas" autofocus>
            </div>
            <div class="form-group">
              <label for="username">username</label>
              <input type="text" id="username" class="form-control" placeholder="username" required name="username" autofocus>
            </div>
            <div class="form-group">
              <label for="telephone">Telephone</label>
              <input type="number" id="telephone" class="form-control" placeholder="08xxxxxxxx." required name="telephone" autofocus>
            </div>
            <div class="form-group">
              <label for="">Role</label>
              <select name="level" id="" class="form-control">
                <option value="admin">admin</option>
                <option value="petugas">petugas</option>
              </select>
            </div>
            <div class="form-group">
              <label for="inputPassword">Password</label>
              <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password" required>
            </div>
            <div class="form-group">
              <label for="inputPassword">Konfirmasi Pasword</label>
              <input type="password" id="inputPassword" class="form-control" placeholder="konfirmasi password" name="konfirmasi_password"
                required>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Register</button>
            <a href="index.php" class="btn btn-danger">kembali</a>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

Registrasi

<?php require('../layouts/footer.php')  // menyisipkan file layout footer?>