<?php 

include_once"config.php";

$username = $_POST['username'];
$password = $_POST['password'];

if(cek_setting("username",$username) and cek_setting("password",$password)){
	//login sukses
	$_SESSION['login'] = sha1(md5(microtime(true)));
	update_setting("token",$_SESSION['login']);
	pesan("success","Log In Success","../index.php");
} else {
	pesan("danger","Log In Gagal","../index.php");
}


 ?>