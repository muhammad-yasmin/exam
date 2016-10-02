<?php
//----------------------------------------------
require "../../../../config/classDB.php";
$conn = new Database();
//----------------------------------------------
$id_bank = $_POST['idkey'];
$where = array('id_bank_soal_ujian'=>$id_bank);

$proses1 = $conn->delete('bank_soal_ujian_tabel', $where);
$proses2 = $conn->delete('isi_soal_tabel', $where);
$proses3 = $conn->delete('pengaturan_nilai_tabel', $where);
$proses4 = $conn->delete('aktivasi_bank_soal', $where);

if($proses1 && $proses2 && $proses3 && $proses4){
	echo "Berhasil Hapus Bank Soal !";
}else{
	echo "Gagal Hapus Bank Soal !";
}
?>