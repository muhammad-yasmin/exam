<?php
//----------------------------------------------
require "../../../../config/classDB.php";
$conn = new Database();
//----------------------------------------------

$id_soal = $_POST['id_soal'];
$jml_opsi = $_POST['bentuk'];
$abcde = ['a','b','c','d','e'];

for ($i=0; $i < $jml_opsi; $i++) { 
	echo strtoupper($abcde[$i]).". ";
    $sel = $conn->fetch("SELECT isi_opsi FROM opsi_".$abcde[$i]."_tabel WHERE id_soal='$id_soal'");
    foreach ($sel as $key => $r_sel) {
        echo $r_sel['isi_opsi']."<br />";
    }
}

?>