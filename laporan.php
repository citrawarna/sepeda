<?php 
include_once("proses/config.php");

if(cek_login()){
	$title = 'Data Member';
	$menu = 4;
	include("view/header.php");

?>

<?php if(isset($_GET['dari']) && isset($_GET['sampai']) && isset($_GET['detail'])){
	$dari = $_GET['dari'];
	$sampai = $_GET['sampai'];
	$detail = $_GET['detail'];

	$showLaporan = $db->query("SELECT * FROM peminjaman 
		INNER JOIN member on member.id_member = peminjaman.id_member
		LEFT JOIN pengembalian on pengembalian.kd_transaksi = peminjaman.kd_transaksi
		INNER JOIN detail_peminjaman on detail_peminjaman.kd_transaksi = peminjaman.kd_transaksi
		INNER JOIN sepeda on sepeda.id_sepeda = detail_peminjaman.id_sepeda
		WHERE tanggal BETWEEN '$dari' AND '$sampai' "); ?>

	<div class="row justify-content-center"><h3>Laporan Transaksi dari tanggal <?= $dari. " Sampai ".$sampai ?></h3></div>
	<a href="" onclick="window.print()">Print</a>
	<table class="table table-sm table-striped">
		<tr>
			<td>#</td>
			<td>No Nota</td>
			<td>Peminjam</td>
			<td>Tanggal & Jam Pinjam</td>
			<td>Tanggal & Jam Kembali</td>
			<td>Jumlah</td>
			<td>Nama Sepeda</td> 
			<td>Durasi</td>
			<td>Harga Sewa</td>
			<td>Status</td>
		</tr>
		<?php $no=1; foreach($showLaporan as $row){  
			?>
		<tr>
			<td><?= $no++ ?></td>
			<td><?= $row['kd_transaksi'] ?></td>			
			<td><?= $row['nama'] ?></td>
			<td><?= $row['tanggal']." | ".$row['jam_pinjam'] ?></td>
			<td><?= $row['tanggal_kembali']." - ".$row['jam_kembali'] ?></td>
			<td><?= $row['jumlah'] ?></td>
			<td><?= $row['nama_sepeda'] ?></td> 
			<td>'<?= $row['durasi_pinjam'] ?>' Jam </td>
			<td><?= $row['durasi_pinjam'] * get_setting("harga") ?></td>
			<td><?php if($row['selesai'] == 'y'){
					echo "Selesai";
				} else {
					echo "Belum Selesai";
				} ?>
			</td>
		</tr>
		<?php } ?>

	</table>

<?php  } else if(isset($_GET['dari']) && isset($_GET['sampai'])) { 

$dari = $_GET['dari'];
$sampai = $_GET['sampai'];

$showLaporan = $db->query("SELECT * FROM peminjaman 
	INNER JOIN member on member.id_member = peminjaman.id_member
	LEFT JOIN pengembalian on pengembalian.kd_transaksi = peminjaman.kd_transaksi
	WHERE tanggal BETWEEN '$dari' AND '$sampai' "); ?>

	<div class="row justify-content-center"><h3>Laporan Transaksi dari tanggal <?= $dari. " Sampai ".$sampai ?></h3></div>
	<a href="" onclick="window.print()">Print</a>
	<table class="table table-sm table-striped">
		<tr>
			<td>#</td>
			<td>No Nota</td>
			<td>Peminjam</td>
			<td>Tanggal & Jam Pinjam</td>
			<td>Tanggal & Jam Kembali</td>
			<td>Total Sepeda</td>
			<td>Durasi Pinjam</td> 
			<td>Biaya</td>
			<td>Status</td>
		</tr>
		<?php $no=1; foreach($showLaporan as $row){  
			?>
		<tr>
			<td><?= $no++ ?></td>
			<td><?= $row['kd_transaksi'] ?></td>			
			<td><?= $row['nama'] ?></td>
			<td><?= $row['tanggal']." | ".$row['jam_pinjam'] ?></td>
			<td><?= $row['tanggal_kembali']." - ".$row['jam_kembali'] ?></td>
			<td><?= $row['total_sepeda'] ?></td>
			<td>'<?= $row['durasi_pinjam'] ?>' Jam</td> 
			<td><?= $row['biaya'] ?></td>
			<td><?php if($row['selesai'] == 'y'){
					echo "Selesai";
				} else {
					echo "Belum Selesai";
				} ?>
			</td>
		</tr>
		<?php } ?>

	</table>



<?php } else { ?>
	<div class="jumbotron" style="margin-top:-24px">
		<h3>Laporan</h3>
		<p class="lead">Tampilkan laporan : </p>
		<form action="proses/add_data.php?fungsi=laporan" method="post">
			<div class="row">
				<div class="col-md-6"><input type="text" name="dari" class="form-control" placeholder="Dari tanggal" required id="datepicker1"></div>
				<div class="col-md-6"><input type="text" name="sampai" class="form-control" placeholder="Sampai tanggal" required id="datepicker2"></div>
			</div>
			<input type="checkbox" name="detail" value="detail">Tampilkan dalam mode detail
			<br><br>
			<input type="Submit" value="Cari">
		</form>
	</div>
<?php } ?>

<?php include_once('view/footer.php') ?>

<?php } else {

	include "login.php";
} ?>