<?php
//----------------------------------------------
require "../../../../config/classDB.php";
$conn = new Database();
//----------------------------------------------

$id_guru = $_POST['idkey'];
$where = array('id_guru'=>$id_guru);

$proses = $conn->delete("guru_tabel", $where);
$proses2 = $conn->delete("mapel_guru_tabel", $where);
$proses3 = $conn->delete("guru_jurusan_tabel", $where);

if($proses && $proses2 && $proses3){
    echo "Berhasil Hapus Data !";
}else{
    echo "Gagal Hapus Data !";
}
?>