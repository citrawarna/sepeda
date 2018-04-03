<?php 
include_once("config.php");

$kd_transaksi = $_GET['kd_transaksi'];
$id_member = $_GET['id_member'];

if(empty($kd_transaksi)){
	pesan("warning", "Masukan nomor nota", "../pengembalian.php");
}

$data = $db->query("SELECT * from peminjaman WHERE kd_transaksi = ".quote($kd_transaksi));
if($data->rowCount() <> 1){
	pesan("danger", "Transaksi tidak ada", "../pengembalian.php");
}
pesan("success", "Silahkan melakukan transaksi pengembalian", "../detail_pengembalian.php?nota=$kd_transaksi");




 ?>