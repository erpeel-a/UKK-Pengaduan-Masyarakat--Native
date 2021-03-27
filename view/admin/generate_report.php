<?php
session_start();
require('../../function.php');
$conn = DBConnection();
  if(!isset($_SESSION['login'])){
    header('location:login.php');
    exit;
  }
  if($_SESSION['level'] != 'admin'){
    header('location:login.php');
  }
$pengaduan = FetchAllData("SELECT * FROM tanggapan T1 INNER JOIN pengaduan P1 ON T1.id_pengaduan=P1.id_pengaduan INNER JOIN petugas P2 ON P2.id_petugas=T1.id_petugas INNER JOIN masyarakat M1 ON P1.nik=M1.nik");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Report</title>
	<link href="<?= site_url ?>/assets/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
	@media print {
		.btn-danger {
			display: none;
		}
	}
</style>
<body>
	<div class="container mt-5">
		<div class="row mt-5">
			<div class="col-12 text-center">
				<h3>
					Laporan Pengaduan Masyarakat
				</h3>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>No</th>
							<th>Nama masyarakat</th>
							<th>Nama Petugas</th>
							<th>Tanggal Pengaduan</th>
							<th>Tanggal Tanggapan</th>
							<th>Isi Pengaduan</th>
							<th>Foto</th>
							<th>Tanggapan</th>
						</tr>
					</thead>
					<tbody>
						<?php $i = 1 ?>
						<?php foreach($pengaduan as $item){ ?>
						<tr>
							<td><?= $i++;?></td>
							<td><?= $item['nama'] ; ?></td>
							<td><?= $item['nama_petugas'] ; ?></td>
							<td><?= $item['tgl_pengaduan'] ?></td>
							<td><?= $item['tgl_tanggapan'] ?></td>
							<td><?= $item['isi_laporan'] ;?></td>
							<td><img src="<?= site_url ?>/img/<?= $item['foto'] ;?>" width="100px" alt=""></td>
							<td><?= $item['tanggapan'] ;?></td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
				<a href="index.php" class="btn btn-danger">kembali</a>
			</div>
		</div>
	</div>
	<script>
		window.print();
	</script>
</body>

</html>