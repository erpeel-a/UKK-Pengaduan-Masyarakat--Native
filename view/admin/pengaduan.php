<?php
session_start(); // mulai session
require '../../function.php'; // menyisipkan file function.php agar bisa di pakai function2 yang ada didalamnya
$conn = DBConnection(); // panggil functio DBConnection dan masukkan ke dalam variable $conn
isPetugas();
isLogin();// panggil fungsi isLogin yang ada di file functions.php
if(isset($_POST['verify'])){ // check jika tombol verify sudah di submit
  $idpengaduan = $_POST['verify']; // tanggap id pengaduan yang dikirim 
  $_SESSION['idpengaduan'] = $idpengaduan; // masukkan id pengaduan ke dalam session
  $cek = mysqli_query($conn, "UPDATE pengaduan SET status ='proses' WHERE id_pengaduan='$idpengaduan'") or die(mysqli_error($conn)); // query ke database
  header('location:tanggapan.php'); // alihkan ke page tanggapan.php
}
// tanggkap data pengaduan dengan fungsi FetchAllData yang sudah didefinisikan di function.php untuk mengambil data yang dikirimkan sebagai parameter dan masukkan dalam variable $pengaduan
  $pengaduan = FetchAllData("SELECT * FROM pengaduan");
  require('../layouts/header.php'); // menyisipkan file layout header
?>
<div class="container mt-5">
  <div class="row">
    <div class="col-10">
      <div class="card">
        <div class="card-header">
          <h3 class="text-center">Daftar Pengaduan :</h3>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>tanggal</th>
                  <th>isi laporan</th>
                  <th>bukti</th>
                  <th>status</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($pengaduan as $data) :
                // check statusnya
                    $status = $data['status'];
                    if($status == '0'){ // jika status 0maka
                      $status = 'terkirim'; // tampilakan "terkirim"
                    }else if($status == 'proses'){ // jika status proses
                      $status = 'diproses';// tampilakan "diproses"
                    }else{
                      $status = 'selesai'; // tampilkan selesai
                    }
                ?>
                <tr>
                  <td><?= $data['tgl_pengaduan'];?></td>
                  <td><?= $data['isi_laporan'];?></td>
                  <td><img src="<?= site_url ?>/img/<?= $data['foto'];?>" width="100px" alt=""></td>
                  <td>
                    <div><?= $status ;?></div>
                  </td>
                  <td>
                    <?php if($data['status'] !== 'selesai') {?>
                    <form action="" method="post">
                      <button value="<?= $data['id_pengaduan'] ;?>" type="submit" "
                    name=" verify" class="btn btn-sm btn-info">Verifikasi Data</button>
                    </form>
                    <?php }else{ ?>
                    <div class="badge badge-success">Pengaduan Sudah Ditanggapi</div>
                    <?php } ?>
                  </td>
                </tr>
                <?php endforeach ;?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <a href="index.php" class="my-2 btn btn-danger">kembali</a>
    </div>
  </div>
</div>
</div>

<!-- menyisipkan layout footer -->
<?php require('../layouts/footer.php'); ?>