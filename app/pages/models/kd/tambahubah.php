<?php
//----------------------------------------------
require "../../../../config/classDB.php";
$conn = new Database();
//----------------------------------------------

//Deklarasi Variabel
$jenis_proses = $_POST['jenis_proses'];
$idprimarykey = $_POST['idprimarykey'];
$idprimarykey2 = $_POST['idprimarykey2'];
$id_kd = $_POST['input_id_kd'];
$id_kd2 = $_POST['input_id_kd2'];
$input_id_mapel = $_POST['input_id_mapel'];
$input_kd3 = $_POST['input_text_kd3'];
$input_kd4 = $_POST['input_text_kd4'];

//Cek No KD
$que_no_kd = $conn->fetch("SELECT
				dk.id_mapel,
				MAX(kd.no_kd) AS new_no_kd
				FROM
				draft_kompetensi_tabel AS dk
				INNER JOIN kompetensi_dasar_tabel AS kd ON dk.id_kompetensi_dasar = kd.id_kompetensi_dasar
				WHERE dk.id_mapel = $input_id_mapel
				");
$nums_no_kd = count($que_no_kd);
if($nums_no_kd > 0){
	foreach ($que_no_kd as $key => $r) {
		$input_new_no_kd = $r['new_no_kd'] + 1;
	}
	
}else{
	$input_new_no_kd = 1;
}

if($jenis_proses == "tambahdata"){
	//Cek Id KD baru
	$que_new_id = $conn->fetch("SELECT MAX(id_kompetensi_dasar) AS max_id FROM kompetensi_dasar_tabel");
	foreach ($que_new_id as $key => $r_id) {
		$input_new_id_kd = $r_id['max_id'] + 1;
	}

	//INSERT KD3
	$kd3val = array("id_kompetensi_dasar"=>$input_new_id_kd, "no_kd"=>$input_new_no_kd, "nama_kompetensi_dasar"=>$input_kd3);
	$p_insert_kd3 = $conn->insert("kompetensi_dasar_tabel", $kd3val);

	//INSERT Draft KD3
	$dk3val = array("id_mapel"=>$input_id_mapel, 
					"id_kompetensi_inti"=>"3",
					"id_kompetensi_dasar"=>$input_new_id_kd);
	$p_insert_dk3 = $conn->insert("draft_kompetensi_tabel", $dk3val);

	//Cek Id KD baru
	$que_new_id = $conn->fetch("SELECT MAX(id_kompetensi_dasar) AS max_id FROM kompetensi_dasar_tabel");
	foreach ($que_new_id as $key => $r_id) {
		$input_new_id_kd = $r_id['max_id'] + 1;
	}

	//INSERT KD4
	$kd4val = array("id_kompetensi_dasar"=>$input_new_id_kd, "no_kd"=>$input_new_no_kd, "nama_kompetensi_dasar"=>$input_kd4);
	$p_insert_kd4 = $conn->insert("kompetensi_dasar_tabel", $kd4val);

	//INSERT Draft KD3
	$dk4val = array("id_mapel"=>$input_id_mapel, 
					"id_kompetensi_inti"=>"4",
					"id_kompetensi_dasar"=>$input_new_id_kd);
	$p_insert_dk4 = $conn->insert("draft_kompetensi_tabel", $dk4val);

	$pesan = ($p_insert_kd3 && $p_insert_dk3 && $p_insert_kd4 && $p_insert_dk4)? "oke_tambah" : "Gagal !";

}else if($jenis_proses == "ubahdata"){
	//UPDATE KD3
	$setkd3 = array("nama_kompetensi_dasar"=>$input_kd3);
	$wherekd3 = array("id_kompetensi_dasar"=>$id_kd);
	$p_update_kd3 = $conn->update("kompetensi_dasar_tabel", $setkd3, $wherekd3);

	//UPDATE KD4
	$setkd4 = array("nama_kompetensi_dasar"=>$input_kd4);
	$wherekd4 = array("id_kompetensi_dasar"=>$id_kd2);
	$p_update_kd4 = $conn->update("kompetensi_dasar_tabel", $setkd4, $wherekd4);

	//UPDATE Draft KD3
	$setdk3 = array("id_mapel"=>$input_id_mapel);
	$wheredk3 = array("id_draft_kompetensi"=>$idprimarykey);
	$p_update_dk3 = $conn->update("draft_kompetensi_tabel", $setdk3, $wheredk3);

	//UPDATE Draft KD4
	$setdk4 = array("id_mapel"=>$input_id_mapel);
	$wheredk4 = array("id_draft_kompetensi"=>$idprimarykey2);
	$p_update_dk4 =  $conn->update("draft_kompetensi_tabel", $setdk4, $wheredk4);

	$pesan = ($p_update_kd3 && $p_update_dk3 && $p_update_kd4 && $p_update_dk4)? "oke_ubah" : "Gagal !";
		
}
?>
<script>
    window.top.window.hasil_simpan('<?php echo $pesan; ?>');
</script>