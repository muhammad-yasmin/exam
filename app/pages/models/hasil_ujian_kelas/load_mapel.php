<?php
//----------------------------------------------
require "../../../../config/classDB.php";
$conn = new Database();
//----------------------------------------------
$level = $_SESSION['level_nya'];
$id_guru = $_SESSION['id_usernya'];
$idjurusan=$_POST['idjurusan'];
$tingkat=$_POST['tingkat'];

if($level == 1){
	$que_mapel = $conn->fetch("SELECT
	mapel_tabel.nama_mapel,
	mapel_jurusan_tabel.id_mapel,
	mapel_jurusan_tabel.id_mapel_jurusan,
	jurusan_tabel.id_jurusan,
	jurusan_tabel.jurusan,
	mapel_tabel.tingkat
	FROM
	mapel_jurusan_tabel
	INNER JOIN mapel_tabel ON mapel_tabel.id_mapel = mapel_jurusan_tabel.id_mapel
	INNER JOIN jurusan_tabel ON jurusan_tabel.id_jurusan = mapel_jurusan_tabel.id_jurusan
	WHERE (jurusan_tabel.id_jurusan='1' OR jurusan_tabel.id_jurusan='$idjurusan') AND
	mapel_tabel.tingkat='$tingkat';
	");
}else if($level == 2){
	$que_mapel = $conn->fetch("SELECT
	mapel_tabel.nama_mapel,
	mapel_jurusan_tabel.id_mapel,
	mapel_jurusan_tabel.id_mapel_jurusan,
	jurusan_tabel.id_jurusan,
	jurusan_tabel.jurusan,
	mapel_tabel.tingkat,
	mapel_guru_tabel.id_guru
	FROM
	mapel_jurusan_tabel
	INNER JOIN mapel_tabel ON mapel_tabel.id_mapel = mapel_jurusan_tabel.id_mapel
	INNER JOIN jurusan_tabel ON jurusan_tabel.id_jurusan = mapel_jurusan_tabel.id_jurusan
	INNER JOIN mapel_guru_tabel ON mapel_tabel.id_mapel = mapel_guru_tabel.id_mapel
	WHERE (jurusan_tabel.id_jurusan='$idjurusan') AND
	mapel_tabel.tingkat='$tingkat' AND mapel_guru_tabel.id_guru='$id_guru'
	");
}
foreach ($que_mapel as $key => $mapel) {
    ?><option value="<?php echo $mapel['id_mapel'] ?>"><?php echo $mapel['nama_mapel'] ?></option><?php
}
?>