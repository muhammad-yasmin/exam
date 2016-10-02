<?php
//----------------------------------------------
require "../../../../config/classDB.php";
$conn = new Database();
//----------------------------------------------

$id = $_POST['idkey'];

$where = array("id_mapel"=>$id);

$proses = $conn->delete("mapel_tabel", $where);
$proses2 = $conn->delete("kelompok_mapel_tabel", $where);
$proses3 = $conn->delete("mapel_jurusan_tabel", $where);

if($proses && $proses2 && $proses3){
    echo "Berhasil Hapus Data !";
}else{
    echo "Gagal Hapus Data !";
}
?>