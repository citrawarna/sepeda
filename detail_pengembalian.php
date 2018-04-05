<?php 
include_once("proses/config.php");

if(cek_login()){
	$title = 'Detail Pengembalian';
	$menu = 3;
	include("view/header.php");

?>

<?php 
if(isset($_GET['nota'])){
	$get_kode = $_GET['nota'];
	$slcKd = $db->prepare("SELECT * FROM peminjaman INNER JOIN member on member.id_member = peminjaman.id_member WHERE kd_transaksi = '$get_kode' AND selesai='n' ");
	$slcKd->execute();

	if($slcKd->rowCount() != 1){
		pesan("danger", "Data tidak ada atau mungkin sudah di proses", "pengembalian.php");
	} 

	$kd_trans = $slcKd->fetch(); 
	
	$harga = get_setting("harga");
	$total_sepeda = $kd_trans['total_sepeda'];
	$jam_pinjam = strtotime($kd_trans['jam_pinjam']);
	$jam_kembali = strtotime(date('H:i:s'));
	$durasi = round(($jam_kembali - $jam_pinjam) / 3600);
	if($durasi == 0){
		$durasi = 1;
	}
	$total_harga = $durasi * $harga * $total_sepeda;


} else {
		pesan("warning", "Harap Pilih nomor nota terlebih dahulu", "pengembalian.php");
}

?>

<h3>Proses Pengembalian</h3>
<form action="proses/add_data.php?fungsi=pengembalian" method="post">
	<table class="table">
		<tr>
			<td>No Nota </td>
			<td> : </td>
			<input type="hidden" name="kd_transaksi" value="<?= $kd_trans['kd_transaksi'] ?>">
			<td><?= $kd_trans['kd_transaksi'] ?></td>
		</tr>
		<tr>
			<td>Nama Pemesan</td>
			<td> : </td>
			<input type="hidden" name="id_member" value="<?= $kd_trans['id_member']; ?>">
			<td><?= $kd_trans['nama'] ?></td>
		</tr>
		<tr>
			<td>Pinjam </td>
			<td> : </td>
			<td><?= $kd_trans['tanggal'] ?> | <?= $kd_trans['jam_pinjam'] ?></td>
		</tr>
		
		<tr>
			<td>Tanggal Kembali</td>
			<td> : </td>
			<td>
				<input type="text" class="" name="tanggal_kembali" value="<?= date('Y-m-d') ?>">
				<input type="text" class="" name="jam_kembali" value="<?= date('H:i:s') ?>">
			</td>
		</tr>
		<tr>
			<td>Harga Perjam</td>
			<td> : </td>
			<td> <?= $harga ?> </td>
		</tr>
		<tr>
			<td>Durasi</td>
			<td> : </td>
			<input type="hidden" name="durasi_pinjam" value="<?= $durasi ?>">
			<td> <?= $durasi ?> Jam</td>
		</tr>
		<tr>
			<td>Jumlah Sepeda</td>
			<td> : </td>
			<td> 
				<?= $total_sepeda ?> &nbsp;&nbsp;
				<button type="button" class="" data-toggle="modal" data-target="#addModal">
				   Tampilkan sepeda yg dipinjam
				</button> 
			</td>
		</tr>
		<tr>
			<td>Total</td>
			<td> : </td>
			<td><?= $total_harga ?></td>
		</tr>
		<tr>
			<td>Bayar</td>
			<td> : </td>
			<td>
				<input type="hidden" name="biaya" value="<?= $total_harga ?>">
				<input type="text" name="bayar" required>
			</td>
		</tr>
		
	</table>

	<!-- Modal -->
	<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="addModalLabel">Detail Sepeda</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
			      <div class="modal-body">
			        <table class="table table-sm">
		        		<tr>
		        			<td>No</td>
		        			<td>ID</td>
		        			<td>Nama Sepeda</td>
		        			<td>Jumlah</td>
		        		</tr>
		        		<?php $q_sepeda = $db->query("SELECT * FROM detail_peminjaman INNER JOIN sepeda on 
		        		sepeda.id_sepeda = detail_peminjaman.id_sepeda WHERE kd_transaksi = '$get_kode' ");
		        		$no = 1; 
		        		$ids = [];
		        		foreach($q_sepeda as $row) { ?>
		        		<?php array_push($ids, $row['id_sepeda']); ?>
		        		<tr>
		        			<td><?= $no++ ?></td>
		        			<td><?= $row['id_sepeda'] ?></td>
		        			<td><?= $row['nama_sepeda'] ?></td>
		        			<td><?= $row['jumlah'] ?></td>
		        		</tr>
			        	<?php } ?>
			        	<input type="hidden" name="ids" value="<?= implode(',',$ids) ?>">
			        </table>
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			      </div>
		    </div>
		  </div>
		</div>
		<button type="submit" class="btn btn-primary">Simpan</button>
</form>

<?php include_once('view/footer.php') ?>

<?php } else {

	include "login.php";
} ?>