<?php
//----------------------------------------------
require "../../../../config/classDB.php";
$conn = new Database();
//----------------------------------------------

$id = $_POST['idkey'];

$where = array('id_materi'=>$id);
$proses = $conn->delete("materi_tabel", $where);

if($proses){
    echo "Berhasil Hapus Data !";
}else{
    echo "Gagal Hapus Data !";
}
?>