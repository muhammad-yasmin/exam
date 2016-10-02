<?php
//----------------------------------------------
require "../../../../config/classDB.php";
$conn = new Database();
//----------------------------------------------

$id = $_POST['idkey'];

$where = array('id_jurusan'=>$id);

$proses = $conn->delete('jurusan_tabel', $where);

if($proses){
    echo "Berhasil Hapus Data !";
}else{
    echo "Gagal Hapus Data !";
}
?>