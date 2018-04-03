<?php 

require('../proses/config.php');

$query = $db->query("select * from sepeda where ready != 0");
while($data = $query->fetch(PDO::FETCH_ASSOC)){
	$res[] = $data;
}
echo json_encode($res);

