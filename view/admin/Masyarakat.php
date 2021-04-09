<?php
session_start(); // mulai session
require '../../function.php'; // menyisipkan file function.php agar bisa di pakai function2 yang ada didalamnya
$conn = DBConnection(); // panggil functio DBConnection dan masukkan ke dalam variable $conn
isLogin();// panggil fungsi isLogin yang ada di file functions.php
// tanggkap data masyarakat dengan fungsi FetchAllData yang sudah didefinisikan di function.php untuk mengambil data yang dikirimkan sebagai parameter dan masukkan dalam variable $petugas
isPetugas();
$masyarakat = FetchAllData("SELECT * FROM masyarakat");
require('../layouts/header.php'); // memanggil layout header
?>

<div class="container mt-5">
  <div class="row">
    <div class="col">
      <div class="card">
      <div class="card-header">
        <h2 class="text-center">Daftar Masyarakat</h2>
      </div>
        <div class="card-body">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Nik</th>
                <th>Nama</th>
                <th>Username</th>
                <th>telp</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($masyarakat as $data) : ;?>
              <tr>
                <td><?= $data['nik'];?></td>
                <td><?= $data['nama'];?></td>
                <td><?= $data['username'];?></td>
                <td><?= $data['telp'];?></td>
              </tr>
              <?php endforeach ;?>
            </tbody>
          </table>
        </div>
      </div>
      <a href="index.php" class="my-5 btn btn-danger">kembali</a>
    </div>
  </div>
</div>

<!--  memanggil layout footer -->
<?php require('../layouts/footer.php'); ?>