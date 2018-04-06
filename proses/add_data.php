<?php 
include_once('config.php');

switch ($_GET['fungsi']) {
	case 'add_member':
		$nama = $_POST['nama'];
		$tipe = $_POST['tipe'];
		$kitas = $_POST['kitas'];
		$telp = $_POST['telp'];

		if(empty($nama) || empty($tipe) || empty($kitas) || empty($telp)){
			pesan("warning", "Mohon mengisi semua kolom yang disediakan", "../index.php");
		}

		$cek = $db->query("SELECT * FROM member WHERE kitas = ".quote($kitas));
		if($cek->rowCount() != 0){
			pesan("danger", "Data member sudah ada!", "../index.php");
		}

		$insert = $db->query("INSERT INTO member VALUES (null, ".quote($nama).", ".quote($kitas).", 
			".quote($tipe).", ".quote($telp).", 1, 'n')");
		pesan("success", "Data member berhasil ditambah", "../index.php");
		break;

	case 'add_sepeda':
		$nama_sepeda = $_POST['nama_sepeda'];
		$jumlah_sepeda = $_POST['jumlah_sepeda'];

		if(empty($nama_sepeda) || empty($jumlah_sepeda)){
			pesan("warning", "Mohon mengisi semua kolom yang disediakan", "../sepeda.php");
		}

		$insert = $db->query("INSERT INTO sepeda VALUES (null, ".quote($nama_sepeda).", ".quote($jumlah_sepeda).", 0, ".quote($jumlah_sepeda)." )");

		pesan("success", "Data sepeda berhasil ditambahkan", "../sepeda.php");

		break;

	case 'add_peminjaman':
		$id_member = $_POST['member'];
		$tanggal = $_POST['tanggal'];
		$jam_pinjam = $_POST['jam_pinjam'];
		$total_sepeda = $_POST['total_sepeda'];
		$dibawa = 0;

		if(empty($id_member) || empty($tanggal) || empty($jam_pinjam) || empty($total_sepeda)){
			pesan("warning", "Mohon mengisi semua kolom yang disediakan", "../peminjaman.php");
		}

		//insert data peminjaman
		$ins_peminjaman = $db->query("INSERT INTO peminjaman VALUES (null, ".quote($id_member). "," 
			.quote($tanggal). "," .quote($jam_pinjam). "," .quote($total_sepeda). ", 0, 'n')");

		//ubah status member jadi sedang meminjam (0);
		$stat_member = $db->query("UPDATE member SET status = '0' WHERE id_member = '$id_member' ");
		
		//setelah data terinput di select untuk get kd_transaksi agar dapat insert detail sepeda yg dipinjam
		$selectTrans = $db->query("SELECT * FROM peminjaman WHERE id_member = '$id_member' AND selesai = 'n' ");
		if(is_array($selectTrans) || is_object($selectTrans)){
			foreach($selectTrans as $row){
				$kd = $row['kd_transaksi'];
				pesan("success", "Silahkan masukan detail sepeda", "../detail_peminjaman.php?nota=$kd");
			}
		}
		
		break;

	case 'pengembalian':
		$kd_transaksi = $_POST['kd_transaksi'];
		$id_member = $_POST['id_member'];
		$tanggal_kembali = $_POST['tanggal_kembali'];
		$jam_kembali = $_POST['jam_kembali'];
		$biaya = $_POST['biaya'];
		$ids = $_POST['ids'];
		$bayar = $_POST['bayar'];
		$durasi_pinjam = $_POST['durasi_pinjam'];

		//proses insert ke tbl pengembalian
		$ins = $db->query("INSERT INTO pengembalian VALUES (".quote($kd_transaksi).", ".quote($tanggal_kembali)."
			, ".quote($jam_kembali).", ".quote($durasi_pinjam).", ".quote($biaya).")");
		
		//update tb peminjaman ganti status selesai = y 
		$upd_pem = $db->query("UPDATE peminjaman SET selesai = 'y', dibawa = 0 WHERE kd_transaksi = ".quote($kd_transaksi)." ");

		//update status member = 1 (agar bisa pinjam)
		$upd_mem = $db->query("UPDATE member SET status = 1 WHERE id_member = $id_member ");

		//update tb detail peminjaman ubah status kembali = y
		$upd_dtl = $db->query("UPDATE detail_peminjaman SET kembali = 'y' WHERE kd_transaksi = '$kd_transaksi' ");

		//thx to surya was creating this function
		foreach (explode(',', $ids) as $id) {
			$stock_update = $db->query("select dipinjam,ready from sepeda where id_sepeda = '".$id."' limit 1");
			$data = $stock_update->fetch();
			$new_dipinjam = $data['dipinjam'] - 1;
			$new_ready = $data['ready'] + 1;
			$db->query("UPDATE sepeda set dipinjam = $new_dipinjam, ready = $new_ready where id_sepeda = '".$id."'");
		}

		$kembalian = $bayar - $biaya;

		pesan("success", "Transaksi pengembalian berhasil", "../pengembalian_selesai.php?nota=$kd_transaksi&susuk=$kembalian");


		break;

	case 'laporan':
		$dari = $_POST['dari'];
		$sampai = $_POST['sampai'];
		$detail = $_POST['detail'];

		$show = $db->query("SELECT * FROM peminjaman WHERE tanggal BETWEEN '$dari' AND '$sampai' ");
		if($show->rowCount() == 0){
			echo "<script>alert('Tanggal tidak Valid atau data tidak ada'); location.href='../laporan.php'</script>";
		}

		if(empty($detail)){
			pesan("", "", "../laporan.php?dari=$dari&sampai=$sampai");
		} else if(isset($detail)) {
			pesan("", "", "../laporan.php?dari=$dari&sampai=$sampai&detail=$detail");
		}


		break;


	
	default:
		# code...
		break;
}

 ?>