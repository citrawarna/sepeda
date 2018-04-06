<?php 
include_once('config.php');

$delete = $_GET['delete'];
$id = intval($_GET['id']);

switch ($delete) {
	case 'member':
		$softDelete = $db->query("UPDATE member SET hapus = 'y' WHERE id_member = '$id' ");
		pesan("success", "Data berhasil dihapus", "../index.php");
		break;
	
	default:
		# code...
		break;
}
 ?>