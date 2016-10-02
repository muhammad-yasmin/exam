<?php
//----------------------------------------------
require "../../../../config/classDB.php";
$conn = new Database();
//----------------------------------------------
$id_mapel = $_POST['id_mapel'];
$nokd = $_POST['no_kd'];
if($nokd !== "-"){
	$query_indikator = "SELECT
						k.nama_kompetensi_dasar
						FROM
						draft_kompetensi_tabel AS d
						INNER JOIN kompetensi_dasar_tabel AS k ON d.id_kompetensi_dasar = k.id_kompetensi_dasar
						WHERE d.id_mapel = $id_mapel
						AND k.no_kd = $nokd";
	$proses_query_indikator = $conn->fetch($query_indikator);

	$index = array();
	foreach ($proses_query_indikator as $key => $result) {
		array_push($index, $result['nama_kompetensi_dasar']);
	}

	//1
	$text_pisah1 = explode(" ", $index[0]);
	$kata1 = array();
	for ($i=1; $i < count($text_pisah1); $i++) { 
		array_push($kata1, $text_pisah1[$i]);
	}
	$text_jadi1 = implode(" ", $kata1);


	//2
	$text_pisah2 = explode(" ", $index[1]);
	$kata2 = array();
	for ($i=1; $i < count($text_pisah2); $i++) { 
		array_push($kata2, $text_pisah2[$i]);
	}
	$text_jadi2 = implode(" ", $kata2);

	$text_indikator = "Disajikan ".$text_jadi1.", siswa dapat menyajikan ".$text_jadi2;
}else{
	$text_indikator = "-";
}

echo $text_indikator;
?>
<input type="hidden" name="input_id_indikator" value="<?php echo $text_indikator; ?>">