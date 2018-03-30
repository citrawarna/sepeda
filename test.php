<?php include_once("proses/config.php");

	if(!cek_login()){
		header("location:index.php");
	}

	$title = "Halaman Test";
	$menu = 2;
	include('view/header.php');

 ?>