<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title> <?= $title; ?> - Rental Sepeda</title>
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/jquery-ui-1.9.2.custom.min.css">
	<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
	<link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
	<link rel="icon" href="<?= base_url('img/logo-sepeda.png') ?>">
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/bootstrap.js"></script>
	<script src="js/jquery-ui.min.js"></script>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-warning">
		<div class="container">
			<a class="navbar-brand" href="<?= base_url(); ?>"> 
				<img src="<?= base_url('img/logo-sepeda.png') ?>" width="40px;">Rent Bicycle
			</a>
			<ul class="navbar-nav">
		      <li class="nav-item <?php if($menu==1) echo "active"; ?>">
		        <a class="nav-link" href="<?= base_url() ?>">Member </a>
		      </li>
		      <li class="nav-item <?php if($menu==2) echo "active"; ?>">
		        <a class="nav-link" href="<?= base_url('sepeda.php') ?>">Sepeda </a>
		      </li>
		      <li class="nav-item dropdown ">
		        <a class="nav-link dropdown-toggle <?php if($menu==3) echo 'active' ?>" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		          Transaksi
		        </a>
		        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
		          <a class="dropdown-item" href="<?= base_url('peminjaman.php') ?>">Peminjaman</a>
		          <a class="dropdown-item" href="#">Pengembalian</a>
		        </div>
		      <li class="nav-item ">
		        <a class="nav-link" href="<?= base_url('...'); ?>">Laporan</a>
		      </li>
		      <li class="nav-item">
		        <a class="nav-link btn btn-danger" href="<?= base_url('proses/logout.php'); ?>">Logout</a>
		      </li>
		    </ul>
	    </div>
	</nav>
	
	<div class="container">
	<br>
	<?= msghandling(); ?>