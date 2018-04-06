<?php 
include_once("proses/config.php");

if(cek_login()){
	$title = 'Data Member';
	$menu = 1;
	include("view/header.php");

?>
		<br>
		<h3>Data Pelanggan </h3>
		
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal">
		  Tambah Data
		</button>
		<br><br>

		<?php 
			$data = $db->query("SELECT * FROM member WHERE hapus = 'n' ORDER BY nama ");
			$no = 1;
			$jenis = array('', 'KTP', 'SIM', 'KTM', 'KP');
		 ?>
		<table class="table table-sm">
			<tr>
				<th>#</th>
				<th>Nama</th>
				<th>No Kitas</th>
				<th>Jenis</th>
				<th>Action</th>
			</tr>
			<?php foreach($data as $row) { ?>
			<tr>	
				<td><?= $no++ ?></td>
				<td><?= $row['nama']; if($row['status'] == 0) echo "<span class='ket'> Sedang meminjam</span>" ?>  </td>
				<td><?= $row['kitas'] ?></td>
				<td><?php
					if($row['tipe'] == 1) echo "KTP"; 
					else if($row['tipe'] == 2) echo "SIM"; 
					else if($row['tipe'] == 3) echo "KTM"; 
					else if($row['tipe'] == 4) echo "KP" ?></td>
				<td><a href="<?= "proses/delete.php?delete=member&id=".$row['id_member']; ?>" 
					class="btn btn-danger btn-sm <?php if($row['status']=='0') echo "disabled" ?>"
					onclick="return confirm('Yakin hapus data?');">Hapus</a>
				</td>	
			</tr>
			<?php } ?>
		</table>

		<!-- Modal -->
		<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="addModalLabel">Form Add Data Member/Pemesan</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <form action="proses/add_data.php?fungsi=add_member" method="post">
			      <div class="modal-body">
			        <table class="table table-sm">
			        		<tr>
			        			<td>Nama</td>
			        			<td> : </td>
			        			<td><input type="text" class="form-control" name="nama"></td>
			        		</tr>
			        		<tr>
			        			<td>Tipe</td>
			        			<td> : </td>
			        			<td>
			        				<select name="tipe" class="form-control">
			        					<option value="1">KTP</option>
			        					<option value="2">SIM</option>
			        					<option value="3">KTM</option>
			        					<option value="4">KP</option>
			        				</select>
			        			</td>
			        		</tr>
			        		<tr>
			        			<td>No. Kitas</td>
			        			<td> : </td>
			        			<td><input type="text" class="form-control" name="kitas"></td>
			        		</tr>
			        		<tr>
			        			<td>Telp</td>
			        			<td> : </td>
			        			<td><input type="text" class="form-control" name="telp"></td>
			        		</tr>
			        		<tr>
			        			<td colspan="3" align="right"></td>
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