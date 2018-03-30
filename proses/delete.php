<?php 
include_once('config.php');

$delete = $_GET['delete'];
$id = intval($_GET['id']);

switch ($delete) {
	case 'member':
		$del = $db->query("DELETE FROM member WHERE id =". quote($id). "AND status = 1");
		pesan("success", "Data berhasil dihapus", "../index.php");
		break;
	
	default:
		# code...
		break;
}
 ?>