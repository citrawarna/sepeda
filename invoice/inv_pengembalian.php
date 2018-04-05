<?php 
include_once("../proses/config.php");

if(cek_login()){
 ?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Print Nota Pengembalian</title>
	<link rel="stylesheet" href="../css/bootstrap.css">
</head>
<script>
	var css = '@page { size: landscape; }',
    head = document.head || document.getElementsByTagName('head')[0],
    style = document.createElement('style');

	style.type = 'text/css';
	style.media = 'print';

	if (style.styleSheet){
	  style.styleSheet.cssText = css;
	} else {
	  style.appendChild(document.createTextNode(css));
	}

	head.appendChild(style);

</script>
<body>
	 <?php 
	 if(isset($_GET['nota']) && isset($_GET['susuk'])){
	 	$nota = $_GET['nota'];
	 	$query = $db->query("SELECT * FROM peminjaman 
	 		INNER JOIN member on member.id_member = peminjaman.id_member
	 		INNER JOIN pengembalian on pengembalian.kd_transaksi = peminjaman.kd_transaksi 
	 		WHERE peminjaman.kd_transaksi = '$nota'");
	 	$data = $query->fetch();
	 	$susuk = $_GET['susuk'];
	 } else {
	 	pesan("danger", "Data tidak ada", "../pengembalian.php");
	 }
	 
	  ?>
	<h2><img src="../img/logo-sepeda.png" alt="logo" width="80px;"> Rent Sepeda <p class="lead">Solusi Sewa Sepeda yang paling tepat</p></h2>
	
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
	 		<td>Pelanggan</td>
	 		<td></td>
	 		<td>Petugas</td>
	 	</tr>
  	</table>
  	<br><br>
  	<table>
  		<tr>
	 		<td>(<?php for($i=1; $i<=50; $i++) { echo "&nbsp;"; } ?>) </td>
	 		<td style="visibility:hidden">(<?php for($i=1; $i<=30; $i++) { echo "&nbsp;"; } ?>) </td>
	 		<td style="visibility:hidden">(<?php for($i=1; $i<=20; $i++) { echo "&nbsp;"; } ?>) </td>
	 		<td style="visibility:hidden">(<?php for($i=1; $i<=20; $i++) { echo "&nbsp;"; } ?>) </td>
	 		<td>(<?php for($i=1; $i<=50; $i++) { echo "&nbsp;"; } ?>) </td>
	 	</tr>

  	</table>

</body>
</html>
 



 <?php } else {
 	include "../login.php";
 } ?>