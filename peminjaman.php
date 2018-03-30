<?php 
include_once("proses/config.php");

if(cek_login()){
	$title = 'Transaksi Peminjaman';
	$menu = 3;
	include("view/header.php");
?>

	<h3>Tambah Transaksi Peminjaman</h3>
	
	<form action="proses/add_data.php?fungsi=add_peminjaman" method="post">
		<table class="table">
			<tr>
				<td>Nama Peminjaman</td>
				<td> : </td>
				<td><input type="text" class="form-control" name="id_member"></td>
			</tr>
			<tr>
				<td>Tanggal</td>
				<td> : </td>
				<td><input type="text" class="form-control" name="tanggal" value="<?= date('Y-m-d'); ?>"></td>
			</tr>
			<tr>
				<td>Jam Pinjam</td>
				<td> : </td>
				<td><input type="text" class="form-control" name="jam_pinjam" value="<?= date('H:i:s'); ?>"></td>
			</tr>
			<tr>
				<td>Total Sepeda</td>
				<td> : </td>
				<td><input type="text" class="form-control" name="total_sepeda"></td>
			</tr>
			<tr>
				<td colspan="3" align="right"><input type="submit" value="Proses" class="btn btn-primary"></td>
			</tr>
		</table>
	</form>

<?php include_once('view/footer.php') ?>

<?php } else {

	include "login.php";
} ?>