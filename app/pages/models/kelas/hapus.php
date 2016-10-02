<?php
//----------------------------------------------
require "../../../../config/classDB.php";
$conn = new Database();
//----------------------------------------------

$id = $_POST['idkey'];

$where = array('id_kelas'=>$id);

$query1 = $conn->delete("draft_kelas_tabel", $where);
$query2 = $conn->delete("kelas_tabel", $where);

if($query1 && $query2){
    echo "Berhasil Hapus Data !";
}else{
    echo "Gagal Hapus Data !";
}
?>