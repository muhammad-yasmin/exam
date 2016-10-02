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
    $id_mapel = $data->sheets[0]["cells"][$i][1];
    $semester = $data->sheets[0]["cells"][$i][2];
    $isi_soal = $data->sheets[0]["cells"][$i][3];
    $jml_opsi = $data->sheets[0]["cells"][$i][4];
    $pisah_abjad = [];
    $no_opsi = 5;
    for ($j=0; $j < $jml_opsi; $j++) { 
        array_push($pisah_abjad, $data->sheets[0]["cells"][$i][$no_opsi]);
        $no_opsi++;
    }
    $jawaban = $data->sheets[0]["cells"][$i][10];
    $pembahasan = $data->sheets[0]["cells"][$i][11];

    if(isset($pembahasan)){
        $pembahasan = $data->sheets[0]["cells"][$i][11];
    }else{
        $pembahasan = "-";
    }

    $abcde = ['A','B','C','D','E'];

    //membuat id_soal baru
    $sel = $conn->fetch("SELECT id_soal FROM soal_tabel ORDER BY id_soal DESC LIMIT 0,1");
    if(count($sel) > 0){
        foreach ($sel as $key => $r_sel) {
            $no_sl = $r_sel['id_soal'] + 1;
        }
    }else{
        $no_sl = 1;
    }

    //insert ke soal_tabel
    $values_soal = array('id_soal'=>$no_sl,
                        'soal'=>$isi_soal,
                        'jawaban'=>$jawaban,
                        'jml_opsi'=>$jml_opsi,
                        'pembahasan'=>$pembahasan);
    $p_insert_soal = $conn->insert("soal_tabel", $values_soal);

    //INSERT OPSI
    for ($k=0; $k < count($pisah_abjad); $k++) { 
        $isi_abjad = $pisah_abjad[$k];
        $values_opsi = array('isi_opsi'=>$isi_abjad, 'id_soal'=>$no_sl);
        $conn->insert("opsi_".strtolower($abcde[$k])."_tabel", $values_opsi);
    }

    $values_kartu = array('semester'=>$semester,
                            'id_mapel'=>$id_mapel,
                            'id_soal'=>$no_sl,
                            'status_verifikasi'=>'belum');
    $p_insert_kartu = $conn->insert('draft_kartu_tabel', $values_kartu);
}

if($p_insert_soal && $p_insert_kartu){
    $pesan = 'Berhasil Tambah Soal !';
}else{
    $pesan = 'Gagal Tambah Soal !';
}
?>
<script>
    window.top.window.hasil_simpan('<?php echo $pesan; ?>');
</script>