<?php 

include_once('proses/config.php');

if(cek_login()){
	$title = "Data Sepeda";
	$menu = 2;
	include("view/header.php");

 ?>

		<br>
		<h3>Data Sepeda </h3>
		
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal">
		  Tambah Data
		</button>
		<br><br>

		<?php 
			$data = $db->query("SELECT * FROM sepeda ORDER BY nama_sepeda");
			$no = 1;
		 ?>

		<table class="table table-sm">
			<tr>
				<td>#</td>
				<td>Nama Sepeda</td>
				<td>Jumlah Sepeda</td>
				<td>Dipinjam</td>
				<td>Stock Ready</td>
			</tr>
			<?php foreach($data as $row) { ?>
			<tr>
				<td><?= $no++ ?></td>
				<td><?= $row['nama_sepeda']; ?></td>
				<td><?= $row['jumlah_sepeda'] ?></td>
				<td><?= $row['dipinjam'] ?></td>
				<td><?= $row['jumlah_sepeda'] - $row['dipinjam'] ?></td>
			</tr>
			<?php } ?>
		</table>

		<!-- Modal -->
		<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="addModalLabel">Form Add Data Sepeda</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <form action="proses/add_data.php?fungsi=add_sepeda" method="post">
			      <div class="modal-body">
			        <table class="table table-sm">
		        		<tr>
		        			<td>Nama Sepeda</td>
		        			<td> : </td>
		        			<td><input type="text" class="form-control" name="nama_sepeda"></td>
		        		</tr>
		        		<tr>
		        			<td>Jumlah</td>
		        			<td> : </td>
		        			<td><input type="number" name="jumlah_sepeda"></td>
		        		</tr>
			        	
			        </table>
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			        <input type="submit" class="btn btn-primary" value="Simpan">
			      </div>
		      </form>
		    </div>
		  </div>
		</div>

<?php include_once('view/footer.php') ?>

<?php } else {

	include "login.php";
} ?>