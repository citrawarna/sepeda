<?php 
session_start();

$dbname = "sepeda";
$username = "root";
$pass = "";
$db = new PDO("mysql:host=localhost;dbname=$dbname;charset=utf8",$username,$pass);

define("BASE_URL", "http://localhost/sepeda/");

date_default_timezone_set("Asia/Makassar");


function base_url($url = null){
	if(empty($url)){
		return BASE_URL;
	} else {
		return BASE_URL."$url";
	}
}	

function quote($txt){
	global $db;
	return $db->quote($txt);
}

function cek_login(){
	if(isset($_SESSION['login'])){
		return cek_setting("token", $_SESSION['login']);
	}
	return false;
}

function cek_setting($param, $value){
	global $db;
	$cek = $db->query("SELECT * FROM setting WHERE param = ".quote($param)." AND value = ".quote($value));
	if($cek->rowCount()==1){
		return true;
	} else {
		return false;
	}
}

function update_setting($param, $value){
	global $db;
	$update = $db->query("UPDATE setting SET value = ".quote($value)." WHERE param = ".quote($param)); 
}

function get_setting($param){
	global $db; 
	$cek = $db->query("SELECT * FROM setting WHERE param = ". quote($param));
	foreach($cek as $r){
		return $r['value'];
	}
}

function pesan($tag, $isi, $loc=null){
	$_SESSION[$tag] = $isi;
	if(!empty($loc)){
		header("location:$loc");
		exit;
	}
}

function msghandling($arr = array("danger", "success", "warning")){
	foreach($arr as $r){
		if(isset($_SESSION[$r])){
			echo "<div class='alert alert-$r'>$_SESSION[$r]</div>";
			unset($_SESSION[$r]);
		}
	}
}

 ?>