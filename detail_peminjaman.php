<?php 
include_once("proses/config.php");

if(cek_login()){
	$title = 'Detail Peminjaman';
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
<form action="proses/proses_detail.php" method="post" name="detail_peminjaman">
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
			<input type="hidden" name="sepeda">
			<td><button type="button" class="btn btn-sm btn-danger fa fa-minus btn-minus disabled">-</button></td>
			<input type="hidden" class="form-control" name="jumlah_sepeda" value="1">
		</tr>
	</table>
	<!-- <div class="order-btn">
		<a href="#" class="btn-plus"><i class="fa fa-plus"></i> Tambah</a>
	</div> -->
	<div align="right" style="margin-right:70px">
    <input type="submit" value="Simpan" class="btn btn-primary">		
	</div>

</form>
<script type="text/javascript">
	$(document).ready(function(){
		var sepeda = $('input[name=id_sepeda]');
		var data_sepeda = [];
		var dat = [];
		$.ajax({
			url: 'request_ajax/req_sepeda.php',
			method: 'GET',
			success: function(data){
				var res = JSON.parse(data);
				for(var o in res){
					var d = {id_sepeda:res[o].id_sepeda, nama_sepeda:res[o].nama_sepeda};
					dat.push(res[o].nama_sepeda);
					data_sepeda.push(d); 
				}
			}
		});
		sepeda.autocomplete({
			source: dat,
			change: function(event, ui){
				var value = ui;
				var data = data_sepeda.find(function(val){
					return val.nama_sepeda == sepeda.val();
				});
				$('input[name=sepeda]').val(data.id_sepeda);
			}
		});
	});
</script>

<?php include_once('view/footer.php') ?>

<?php } else {

	include "login.php";
} ?>

