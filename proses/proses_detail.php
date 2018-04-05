<?php 
include_once('config.php');

$kd_transaksi = $_POST['kd_transaksi'];
$id_sepeda = $_POST['sepeda'];
$jumlah = 1;

//select table peminjaman untuk diupdate jumlah sepeda yg sudah dibawa
$get_dibawa = $db->prepare("SELECT * FROM peminjaman WHERE kd_transaksi = ".quote($kd_transaksi));
$get_dibawa->execute();

$jumlah_spd = $get_dibawa->fetch();

$jml = $jumlah_spd['dibawa'] + $jumlah;

//print_r($jumlah);

if($jumlah_spd['total_sepeda'] <= $jumlah_spd['dibawa']){
	pesan("danger", "Semua sepeda sudah dibawa", "../peminjaman.php");
 }

//insert to table detail peminjaman
$ins_detail = $db->query("INSERT INTO detail_peminjaman VALUES (".quote($kd_transaksi).", 
	".quote($id_sepeda).", 1, 'n')" );

//select tabel sepeda untuk diupdate stok sepeda yang ada dan yg dipinjam
$get_sepeda = $db->prepare("SELECT * FROM sepeda WHERE id_sepeda = '$id_sepeda'");
$get_sepeda->execute();
$rowSpd = $get_sepeda->fetch();

$sepedaReady = $rowSpd['ready'];
$sepedaDipinjam = $rowSpd['dipinjam'] + $jumlah;
$sepedaTotal = $rowSpd['jumlah_sepeda'];

$ready = $sepedaReady - 1;

$upd_spd = $db->query("UPDATE sepeda SET dipinjam = '$sepedaDipinjam', ready = '$ready' WHERE id_sepeda = '$id_sepeda' ");


//update sepeda yang dibawa pada tabel peminjaman
$spd_dibawa = $db->query("UPDATE peminjaman SET dibawa = '$jml' WHERE kd_transaksi = '$kd_transaksi' ");
pesan("success", "Berhasil menambahkan sepeda yang dipinjam", "../detail_peminjaman.php?nota=$kd_transaksi");



 ?>