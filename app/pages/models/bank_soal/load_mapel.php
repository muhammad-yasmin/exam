<?php 
error_reporting(0);
//----------------------------------------------
require "../../../../config/classDB.php";
$conn = new Database();
//----------------------------------------------
$level = $_SESSION['level_nya'];
$id_guru = $_SESSION['id_usernya'];

$keyword = $_POST['keyword'];

if(!isset($keyword) || $keyword == ""){
	if($level == 1){
		$query_mapel = "SELECT
		mapel_tabel.nama_mapel,
		mapel_tabel.id_mapel
		FROM
		mapel_tabel
		";
	}else if($level == 2){
		$query_mapel = "SELECT
		mapel_tabel.nama_mapel,
		mapel_tabel.id_mapel
		FROM
		mapel_guru_tabel
		INNER JOIN mapel_tabel ON mapel_guru_tabel.id_mapel = mapel_tabel.id_mapel
		WHERE mapel_guru_tabel.id_guru = $id_guru
		";
	}
}else{
	if($level == 1){
		$query_mapel = "SELECT
		mapel_tabel.nama_mapel,
		mapel_tabel.id_mapel
		FROM
		mapel_tabel
		WHERE mapel_tabel.nama_mapel LIKE '%".$keyword."%'
		";
	}else if($level == 2){
		$query_mapel = "SELECT
		mapel_tabel.nama_mapel,
		mapel_tabel.id_mapel
		FROM
		mapel_guru_tabel
		INNER JOIN mapel_tabel ON mapel_guru_tabel.id_mapel = mapel_tabel.id_mapel
		WHERE mapel_guru_tabel.id_guru = $id_guru
		AND mapel_tabel.nama_mapel LIKE '%".$keyword."%'
		";
	}
}


$proses_mapel = $conn->fetch($query_mapel);
$num_mapel = count($proses_mapel);
if($num_mapel > 0){
	foreach ($proses_mapel as $key => $data_mapel) {
	?>
		<button type="button" class="btn btn-xs btn-info" onclick="load_kartu_soal(<?php echo $data_mapel['id_mapel']; ?>)"><?php echo $data_mapel['nama_mapel']; ?></button>
	<?php
	}
}else{
	?>
		<button type="button" class="btn btn-xs btn-default" disabled="true">Tidak Ada</button>
	<?php
}
?>
