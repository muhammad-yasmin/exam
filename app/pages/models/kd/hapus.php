<?php
//----------------------------------------------
require "../../../../config/classDB.php";
$conn = new Database();
//----------------------------------------------
$id_draft3 = $_POST['id_draft3'];
$id_draft4 = $_POST['id_draft4'];
$id_kd3 = $_POST['id_kd3'];
$id_kd4 = $_POST['id_kd4'];

$where1 = array("id_draft_kompetensi"=>$id_draft3);
$where2 = array("id_draft_kompetensi"=>$id_draft4);
$where3 = array("id_kompetensi_dasar"=>$id_kd3);
$where4 = array("id_kompetensi_dasar"=>$id_kd4);

$que_hapus_draft3 = $conn->delete("draft_kompetensi_tabel", $where1);
$que_hapus_draft4 = $conn->delete("draft_kompetensi_tabel", $where2);
$que_hapus_kd3 = $conn->delete("kompetensi_dasar_tabel", $where3);
$que_hapus_kd4 = $conn->delete("kompetensi_dasar_tabel", $where4);

if($que_hapus_draft3 && $que_hapus_draft4 && $que_hapus_kd3 && $que_hapus_kd4){
	echo "Berhasil Hapus Data !";
}else{
	echo "Gagal Hapus Data !";
}
?>