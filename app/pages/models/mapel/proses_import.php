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
     
	$input_id_kode_mapel = $data->sheets[0]["cells"][$i][1];
	$input_id_kelompok = substr($input_id_kode_mapel, 0, 1);
	$input_id_nama_mapel = $data->sheets[0]["cells"][$i][2];
	$input_id_tingkat = $data->sheets[0]["cells"][$i][3];
	if($input_id_tingkat == 'I' OR $input_id_tingkat == 'II' OR $input_id_tingkat == 'III' OR $input_id_tingkat == 'IV' OR $input_id_tingkat == 'V' OR $input_id_tingkat == 'VI'){
	    $input_satuan_pendidikan = "SD / MI";
	}else if($input_id_tingkat == 'VII' OR $input_id_tingkat == 'VIII' OR $input_id_tingkat == 'IX'){
	    $input_satuan_pendidikan = "SMP / MTs";
	}else{
	    $input_satuan_pendidikan = $data->sheets[0]["cells"][$i][4];
	}

	$input_id_jurusan = $data->sheets[0]["cells"][$i][5];

    $que_select = $conn->fetch("SELECT id_mapel FROM mapel_tabel ORDER BY id_mapel DESC LIMIT 0,1");
    if(count($que_select) > 0){
        foreach ($que_select as $key => $r) {
            $id_mapel_new = $r['id_mapel'] + 1;
        }
    }else{
        $id_mapel_new = 1;
    }
    
    
    $values = array(
                "id_mapel"=>$id_mapel_new,
                "kode_mapel"=>$input_id_kode_mapel,
                "nama_mapel"=>$input_id_nama_mapel,
                "tingkat"=>$input_id_tingkat,
                "satuan_pendidikan"=>$input_satuan_pendidikan
            );
    $proses_tambah = $conn->insert("mapel_tabel", $values);
    
    $values2 = array(
                "nama_kelompok_mapel"=>$input_id_kelompok,
                "id_mapel"=>$id_mapel_new
            );
    $proses_tambah2 = $conn->insert("kelompok_mapel_tabel", $values2);

    $values3 = array('id_mapel'=>$id_mapel_new, 'id_jurusan'=>$input_id_jurusan);
    $proses_tambah3 = $conn->insert("mapel_jurusan_tabel", $values3);
}
$pesan = ($proses_tambah && $proses_tambah2 && $proses_tambah3)? "oke_tambah" : "Gagal !";
?>
 <script>
        window.top.window.hasil_simpan('<?php echo $pesan; ?>');
    </script>