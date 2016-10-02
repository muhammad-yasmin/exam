<?php
//----------------------------------------------
require "../../../../config/classDB.php";
$conn = new Database();
//----------------------------------------------
$level = $_SESSION['level_nya'];
$id_guru = $_SESSION['id_usernya'];

$set = array('lama_waktu'=>'0');
if($level == 1){
	$where = [];
}else if($level == 2){
	$where = array('id_guru'=>$id_guru);
	$que = "UPDATE bank_soal_ujian_tabel SET lama_waktu=0 WHERE id_guru=$id_guru";	
}

$proses = $conn->update('bank_soal_ujian_tabel', $set, $where);

if($proses){
	echo "Semua Bank Soal dinonaktifkan  !";
}else{
	echo "Gagal dinonaktifkan !";
}
?>