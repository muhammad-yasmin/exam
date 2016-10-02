<?php
//----------------------------------------------
require "../../../../config/classDB.php";
$conn = new Database();
//----------------------------------------------
$id_kartu = $_POST['idkey'];

$cek_dulu = $conn->fetch("SELECT * FROM isi_soal_tabel WHERE isi_soal_tabel.id_kartu_soal = $id_kartu");
$nums_cek = count($cek_dulu);

if($nums_cek > 0){
	echo "Soal masih dipakai !";
}else{
	$proses = $conn->fetch("SELECT d.id_soal, s.jml_opsi FROM draft_kartu_tabel AS d 
							INNER JOIN soal_tabel AS s ON d.id_soal = s.id_soal WHERE d.id_kartu_soal='$id_kartu'");
	$abcde = ['a','b','c','d','e'];
	foreach ($proses as $key => $result) {
		$id_soal = $result['id_soal'];
		$jml_opsi = $result['jml_opsi'];
		$where1 = array('id_soal'=>$id_soal);
		$where2 = array('id_kartu_soal'=>$id_kartu);


		for ($i=0; $i < $jml_opsi; $i++) { 
			$conn->delete("opsi_".$abcde[$i]."_tabel", $where1);
		}

		$delete_soal = $conn->delete("soal_tabel", $where1);
		$delete_kartu = $conn->delete("draft_kartu_tabel", $where2);

		if($delete_soal && $delete_kartu){
		    echo "Berhasil Hapus Data !";
		}else{
		    echo "Gagal Hapus Data !";
		}
	}
	
	
}


?>