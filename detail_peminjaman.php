<?php 
include_once("proses/config.php");

if(cek_login()){
	$title = 'Data Member';
	$menu = 3;
	include("view/header.php");

?>

<?php 
if(isset($_GET['nota'])){
	$get_kode = $_GET['nota'];
	$slcKd = $db->prepare("SELECT * FROM peminjaman INNER JOIN member on member.id_member = peminjaman.id_member WHERE kd_transaksi = '$get_kode' ");
	$slcKd->execute();

	if($slcKd->rowCount() != 1){
		pesan("danger", "Data tidak ada", "peminjaman.php");
	} 

	$kd_trans = $slcKd->fetch(); 
} else {
		pesan("warning", "Harap melakukan transaksi terlebih dahulu sebelum melanjutkan", "peminjaman.php");
}

?>

<h3>Detail Sepeda yang dipinjam</h3>
<form action="proses/proses_detail.php" method="post">
	<table class="table" id="order_table">
		<tr>
			<td>No Nota</td>
			<td>Peminjam</td>
			<td>Sepeda</td>
			<td>Hapus</td>
		</tr>
		<tr>
			<td>
				<input type="hidden" value="<?= $kd_trans['kd_transaksi'] ?>" name="kd_transaksi">
				<?= $kd_trans['kd_transaksi'] ?>
			</td>
			<td><?= $kd_trans['nama']; ?></td>
			<td><input type="text" class="form-control" name="id_sepeda"></td>
			<td><button type="button" class="btn btn-sm btn-danger fa fa-minus btn-minus disabled">-</button></td>
			<input type="hidden" class="form-control" name="jumlah_sepeda" value="1">
		</tr>
	</table>
	<div class="order-btn">
		<a href="#" class="btn-plus"><i class="fa fa-plus"></i> Tambah</a>
	</div>
	<div align="right" style="margin-right:70px">
    <input type="submit" value="Simpan" class="btn btn-primary">		
	</div>

</form>

<?php include_once('view/footer.php') ?>

<?php } else {

	include "login.php";
} ?>

