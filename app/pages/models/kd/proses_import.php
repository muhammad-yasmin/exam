<?php
//----------------------------------------------
require "../../../../config/classDB.php";
$conn = new Database();
//----------------------------------------------
include "../../excel_reader2.php";
// file yang tadinya di upload, di simpan di temporary file PHP, file tersebut yang kita ambil
// dan baca dengan PHP Excel Class
$data = new Spreadsheet_Excel_Reader($_FILES['input_id_import']['tmp_name']);
$hasildata = $data->rowcount($sheet_index=0);
// default nilai 
$sukses = 0;
$gagal = 0;

for ($i=2; $i<=$hasildata; $i++)
{
    $input_id_mapel = $data->sheets[0]["cells"][$i][1];
	$input_kd3 = $data->sheets[0]["cells"][$i][2];
	$input_kd4 = $data->sheets[0]["cells"][$i][3];

	//Cek No KD
	$que_no_kd = $conn->fetch("SELECT
					dk.id_mapel,
					MAX(kd.no_kd) AS new_no_kd
					FROM
					draft_kompetensi_tabel AS dk
					INNER JOIN kompetensi_dasar_tabel AS kd ON dk.id_kompetensi_dasar = kd.id_kompetensi_dasar
					WHERE dk.id_mapel = $input_id_mapel
					");
	$nums_no_kd = count($que_no_kd);
	if($nums_no_kd > 0){
		foreach ($que_no_kd as $key => $r) {
			$input_new_no_kd = $r['new_no_kd'] + 1;
		}
		
	}else{
		$input_new_no_kd = 1;
	}

	//Cek Id KD baru
	$que_new_id = $conn->fetch("SELECT MAX(id_kompetensi_dasar) AS max_id FROM kompetensi_dasar_tabel");
	foreach ($que_new_id as $key => $r_id) {
		$input_new_id_kd = $r_id['max_id'] + 1;
	}

	//INSERT KD3
	$kd3val = array("id_kompetensi_dasar"=>$input_new_id_kd, "no_kd"=>$input_new_no_kd, "nama_kompetensi_dasar"=>$input_kd3);
	$p_insert_kd3 = $conn->insert("kompetensi_dasar_tabel", $kd3val);

	//INSERT Draft KD3
	$dk3val = array("id_mapel"=>$input_id_mapel, 
					"id_kompetensi_inti"=>"3",
					"id_kompetensi_dasar"=>$input_new_id_kd);
	$p_insert_dk3 = $conn->insert("draft_kompetensi_tabel", $dk3val);

	//Cek Id KD baru
	$que_new_id = $conn->fetch("SELECT MAX(id_kompetensi_dasar) AS max_id FROM kompetensi_dasar_tabel");
	foreach ($que_new_id as $key => $r_id) {
		$input_new_id_kd = $r_id['max_id'] + 1;
	}

	//INSERT KD4
	$kd4val = array("id_kompetensi_dasar"=>$input_new_id_kd, "no_kd"=>$input_new_no_kd, "nama_kompetensi_dasar"=>$input_kd4);
	$p_insert_kd4 = $conn->insert("kompetensi_dasar_tabel", $kd4val);

	//INSERT Draft KD3
	$dk4val = array("id_mapel"=>$input_id_mapel, 
					"id_kompetensi_inti"=>"4",
					"id_kompetensi_dasar"=>$input_new_id_kd);
	$p_insert_dk4 = $conn->insert("draft_kompetensi_tabel", $dk4val);
}
$pesan = ($p_insert_kd3 && $p_insert_dk3 && $p_insert_kd4 && $p_insert_dk4)? "oke_tambah" : "Gagal !";
?>
 <script>
        window.top.window.hasil_simpan('<?php echo $pesan; ?>');
    </script>