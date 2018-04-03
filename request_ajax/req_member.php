<?php 

require('../proses/config.php');

$qMember = $db->query("SELECT * FROM member WHERE status = 1 ");
while($dta = $qMember->fetch(PDO::FETCH_ASSOC)){
	$resM[] = $dta;
}
echo json_encode($resM);


 ?>