<?php
//----------------------------------------------
require "../../../../config/classDB.php";
$conn = new Database();
//----------------------------------------------

$id = $_POST['idkey'];

$where = array('id_nama_ujian'=>$id);

$proses = $conn->delete('nama_ujian_tabel', $where);

if($proses){
    echo "Berhasil Hapus Data !";
}else{
    echo "Gagal Hapus Data !";
}
?>