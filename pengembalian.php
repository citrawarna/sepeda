<?php 
include_once("proses/config.php");

if(cek_login()){
	$title = "Transaksi Pengembalian";
	$menu = 3;
	include("view/header.php");
 ?>

 <h3>Transaksi Pengembalian</h3>
 
 <form action="proses/pengembalian.php" method="get">
 	<table class="table">
 		<tr>
 			<td>No Nota</td>
 			<td> : </td>
 			<td>
 				<select name="kd_transaksi" id="" class="form-control">
 					<option value="">Pilih </option>
 					<?php $data_member = $db->query("SELECT * FROM peminjaman INNER JOIN member on member.id_member = peminjaman.id_member WHERE selesai = 'n'"); 
 						foreach($data_member as $row){
 					?>
 					<option value="<?= $row['kd_transaksi'] ?>"> <?= $row['kd_transaksi'] ." - ". $row['nama'] ?> </option>
 					<?php } ?>
 				</select>
 			</td>
 		</tr>
 		
 		<tr>
 			<td colspan="3" align="right"><input type="submit" value="Proses"></td>
 		</tr>
 	</table>	

 </form>

<script type="text/javascript">
	$(document).ready(function(){
		var member = $('input[name=id_member]');
		var data_member = [];
		var dat = [];
		$.ajax({
			url:'request_ajax/req_member_pengembalian.php',
			method: 'GET',
			success: function(data){
				var res = JSON.parse(data);
				for(var o in res){
					var d = {id_member:res[o].
						id_member,
						nama:res[o].
						nama};
					dat.push(res[o].
						nama);
					data_member.push(d);
				}
			}
		});

		member.autocomplete({
			source: dat,
			change: function(event, ui){
				var value = ui;
				var data = data_member.find(
					function(val){
						return val.nama == member.val();
					});
				$('input[name=member]').val(
					data.id_member);
			}
		});
	});
</script>


 <?php include_once("view/footer.php"); ?>

 <?php } else {
 	include "login.php";
 } ?>