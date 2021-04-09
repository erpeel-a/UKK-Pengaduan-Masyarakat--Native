<?php

// mendefinisikan konstanta site url digunakan untuk meng-load asset (image, css, atau file js)
define('site_url', 'http://localhost/UKK-Pengaduan-Masyarakat--Native'); // alamat web, ganti sesuai alamat web masing-masing

// fungsi yang di gunakan untuk membuat koneksi ke database
function DBConnection(){
  return mysqli_connect('localhost','root','','pengaduan_masyarakat');
}
// fungsi yang digunakan untuk mengecek apakah user sudah login
function isLogin()
{
  if(!isset($_SESSION['login'])){ // cek jika user belum login
    header('location:login.php'); // alihkan ke login.php
    exit;
  }
}
// function yang digunakan untuk mengecek apakah yang login petugas (agar jika masyarakat yang login, kemudian mengakses halaman admin lalu akan diarahkan ke halaman login)
function isPetugas()
{
  if($_SESSION['level'] !== 'admin' && $_SESSION['level'] !== 'petugas' ){ // cek jika user belum login
    header('location:../logout.php'); 
    exit;
  }
}
// function yang digunakan untuk mengecek apakah yang login mempunyai role admin (digunakan di cetak data laporan)
function isRoleAdmin()
{
  if($_SESSION['level'] !== 'admin'){ // cek jika user belum login
    header('location:index.php'); // alihkan ke login.php
    exit;
  }
}
// function untuk mengecek jika admin iseng masuk ke masyarakat
function isMasyarakat()
{
  if($_SESSION['level'] !== 'masyarakat'){ // cek jika user belum login
    header('location:../logout.php');
    exit;
  }
}



// fungsi yang digunakan  untuk menampikan data sesuai query yang dikirim kan sebagai parameter
function FetchAllData($query)
{
  $conn = DBConnection(); // memanggil fungsi DBConnection dan masukkan ke dalam variable $conn
  $query = mysqli_query($conn, $query); // masukkan variable $conn, dan paramenter $query ke dalam fungsi mysqli_query
  $rows = []; // menyiapkan varible bertipe array kosong
  while ($row = mysqli_fetch_assoc($query)) { // looping hasil query dan di ubah menjadi array assosicative dan masukkan ke dalam variable row
    $rows[] = $row; // masukkan data dari varible $row dan masukkan ke dalam varible $rows (yang berisi array kosong)
  }
  return $rows; // kembalikan data yang sudah masuk ke variable $rows
}

function PetugasRegister($data){
  $conn = DBConnection(); // memanggil fungsi DBConnection dan masukkan ke dalam variable $conn
  // tangkap input user yang dikirimkan sebagai parameter function
  // htmlspecialchars berfungsi untuk menyeleksi inputkan user agar user tidak sembarangan menginputkan data
  $namapetugas = htmlspecialchars($data['namapetugas']);
  $username =htmlspecialchars($data['username']);
  $level = htmlspecialchars($data['level']);
  $telp = htmlspecialchars($data['telephone']);
  $password =htmlspecialchars($data['password']);
  $konfirmasi_password = htmlspecialchars($data['konfirmasi_password']);
 // melakukan query ke database , untuk mengecek apakah username yang di inputkan sudah terdaftar
  $check = mysqli_query($conn,"SELECT * FROM petugas WHERE username='$username'");
  if(mysqli_fetch_All($check)){ // check jika user sudah ada / terdaftar
    echo "<script>alert('akun sudah terdaftar')</script>"; // tampilkan alert
    return false; // return false 
  }
   
  if($password != $konfirmasi_password){ // Check jika password dan konfirmasi password tidak sesuai
    echo
    "
    <script>
    alert('Kombinasi Password Tidak Sesuai, Silahkan coba lagi');
    </script>
    ";
    // tampilaknn alert
    return false;
  }
  // Insert ke dalam database
  $execute = mysqli_query($conn,"INSERT INTO petugas VALUES(null,'$namapetugas','$username','$password','$telp','$level')");
  return mysqli_affected_rows($conn); // affected rows berfungsi untuk mengecek apakah ada baris yang berubah di database
}

function MasyarakatRegister($data){
  $conn = DBConnection(); // memanggil fungsi DBConnection dan masukkan ke dalam variable $conn
   // tangkap input user yang dikirimkan sebagai parameter function
  // htmlspecialchars berfungsi untuk menyeleksi inputkan user agar user tidak sembarangan menginputkan data
  $nik = htmlspecialchars($data['nik']);
  $nama = htmlspecialchars($data['nama']);
  $username = htmlspecialchars($data['nama']);
  $telephone = htmlspecialchars($data['telephone']);
  $password = htmlspecialchars($data['password']);
  $password2 = htmlspecialchars($data['konfirmasi_password']);
  // melakukan query ke database , untuk mengecek apakah username yang di inputkan sudah terdaftar
  $check = mysqli_query($conn,"SELECT * FROM masyarakat WHERE username ='$username' ");
  if(mysqli_fetch_All($check)){ // check apakah username sudah terdaftar
    echo "<script> alert('akun telah terdaftar');</script>"; // tampilakn alert
    return false;
  }
  if($password != $password2){ // Check jika password dan konfirmasi password tidak sesuai
    echo "<script> alert('Kombinasi password tidak sama, silahkan coba lagi')</script>";
  }
  $execute = mysqli_query($conn,"INSERT INTO masyarakat(nik,nama,username,password,telp) VALUES('$nik','$nama','$username','$password','$telephone')"); // melakukan query ke database
  return mysqli_affected_rows($conn);// affected rows berfungsi untuk mengecek apakah ada baris yang berubah di database
}



function InputPengaduan($nik,$data){
  $conn = DBConnection();  // memanggil fungsi DBConnection dan masukkan ke dalam variable $conn
  // menyiapkan data yang sudah di input user, dan ditanggap sebagai paramater fungsi
  // htmlspecialchars berfungsi untuk menyeleksi inputkan user agar user tidak sembarangan menginputkan data
  $nik = $nik;
  $tanggal = date('Y-m-d');
  $isi = htmlspecialchars($data['isi']);
  $status = '0';
  $gambar = upload(); // panggil fungsi upload()
  mysqli_query($conn,"INSERT INTO pengaduan(tgl_pengaduan,nik,isi_laporan,foto,status) VALUES('$tanggal','$nik','$isi','$gambar','$status')"); // melakukan query insert ke database
  return mysqli_affected_rows($conn);
  echo "<script> 
    alert('Data Pengaduan berhasil di kirim');
  </script>";
}

function upload(){

  // menginisialisasi file
  $namaFile = $_FILES['gambar']['name']; // nama file
  $ukuranFile = $_FILES['gambar']['size']; // ukuran
  $error = $_FILES['gambar']['error']; // apakah gambar error
  $tmpName = $_FILES['gambar']['tmp_name']; // temporary name/ nama sementara
  // check eksetensi file yang diijinkan
  $exstensiGambarValid =['jpg','jpeg','png','JPG','JPEG','PNG'];
  $exstensiGambar =pathinfo($namaFile,PATHINFO_EXTENSION);
  //check jika bukan gambar / gambar tidak valid
  if(!in_array($exstensiGambar, $exstensiGambarValid)){
    echo "<script>
      alert('Harap mengupload Gambar, Bukan file lain');
    </script>";
    return false;
  }
  /*
    optional bisa dipakai bisa tidak
  */ 
  // check ukuran file jika ukuran lebih dari 1000000mb
  // if($ukuranFile > 1000000){
  //   echo "
  //   <script>
  //     alert('ukuran gambar terlalu besar');
  //   </script>
  //   ";
  //   // munculkan alert
  //   return false;
  // }
  // buat nama file baru dengan uniqid
  $namaFileBaru = uniqid(); // uniqid digunakan untuk menghasilkan id berdasarkan waktu input user
  $namaFileBaru .= '.';  // gambung / concat dengan . (titik )
  $namaFileBaru .= $exstensiGambar; // gabung dengan ekstensi gambar
  move_uploaded_file($tmpName,'../../img/' . $namaFileBaru);   // pindah file hasil input
  return $namaFileBaru; // kembalikan nama file yang baru
}
