<?php 
include_once("proses/config.php");

if(cek_login()){
	$title = "Transaksi Pengembalian";
	$menu = 3;
	include("view/header.php");
 ?>

 <h3>Pengembalian Selesai</h3>
 <?php 
 if(isset($_GET['nota'])){
 	$nota = $_GET['nota'];
 	$query = $db->query("SELECT * FROM peminjaman 
 		INNER JOIN member on member.id_member = peminjaman.id_member
 		INNER JOIN pengembalian on pengembalian.kd_transaksi = peminjaman.kd_transaksi 
 		WHERE peminjaman.kd_transaksi = '$nota'");
 	$data = $query->fetch();

 }
 $susuk = $_GET['susuk'];
  ?>
 <table class="table table-sm">
 
 	<tr>
 		<td>No Nota </td>
 		<td>:</td>
 		<td><?= $data['kd_transaksi']; ?></td>
 	</tr>
 	<tr>
 		<td>Peminjam </td>
 		<td>:</td>
 		<td><?= $data['nama']; ?></td>
 	</tr>
 	<tr>
 		<td>Jam Pinjam </td>
 		<td>:</td>
 		<td><?= $data['jam_pinjam']; ?></td>
 	</tr>
 	<tr>
 		<td>Jam Kembali </td>
 		<td>:</td>
 		<td><?= $data['jam_kembali']; ?></td>
 	</tr>
 	<tr>
 		<td>Durasi Pinjam </td>
 		<td>:</td>
 		<td><?= $data['durasi_pinjam']; ?> Jam</td>
 	</tr>
 	<tr>
 		<td>Harga Sewa</td>
 		<td> : </td>
 		<td>1 Sepeda <?= get_setting("harga") ?> perjam</td>
 	</tr>
 	<tr>
 		<td>Jumlah Sepeda</td>
 		<td> : </td>
 		<td><?= $data['total_sepeda'] ?> Sepeda</td>
 	</tr>
 	<?php $sepeda =  $db->query("SELECT * from detail_peminjaman INNER JOIN sepeda on sepeda.id_sepeda = detail_peminjaman.id_sepeda WHERE kd_transaksi = '$nota' ") ?>
 	<tr>
 		<td valign="top">List Sepeda</td>
 		<td valign="top"> : </td>
 		<td> 
			<ul>
				<?php foreach($sepeda as $row) { ?>
				<li><?= $row['nama_sepeda'] ?></li>
				<?php } ?>
			</ul>
 		</td>
 	</tr>
 	<tr>
 		<td>Total</td>
 		<td> : </td>
 		<td><?= $data['biaya'] ?></td>
 	</tr>
 	<tr>
 		<td>Bayar </td>
 		<td>: </td>
 		<td><?= $data['biaya'] + $susuk ?></td>
 	</tr>
 	<tr>
 		<td>Kembalian</td>
 		<td>: </td>
 		<td><?= $susuk ?></td>	
 	</tr>
 	<tr>
 		<td colspan="2"></td>
 		<td>
			<a href="<?= "invoice/inv_pengembalian.php?nota=$nota&susuk=$susuk" ?>" target="_blank"><button>Print</button></a>
 			<a href="<?= base_url() ?>" class="btn btn-primary btn-sm">Back to Home</a>
 		</td>
 	</tr>


  </table>


 <?php include_once("view/footer.php"); ?>

 <?php } else {
 	include "login.php";
 } ?>