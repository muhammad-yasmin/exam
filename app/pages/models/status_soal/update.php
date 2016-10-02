<?php
//----------------------------------------------
require "../../../../config/classDB.php";
$conn = new Database();
//----------------------------------------------
$input_id_bank_soal = $_POST['input_id_bank_soal'];
$input_id_lama_waktu = $_POST['input_id_lama_waktu'];

$input_id_tanggalaktif = $_POST['input_id_tanggalaktif'];
$x = explode(" ", $input_id_tanggalaktif);
$tgl = explode("/", $x[0]);
$jam = explode(":", $x[1]);

$input_aktif_bahas = $_POST['input_aktif_bahas'];
$input_fullscreen = (isset($_POST['input_id_fullscreen']))? 1 : 0;
$input_block_text = (isset($_POST['input_id_block_text']))? 1 : 0;
$input_focus = (isset($_POST['input_id_focus']))? 1 : 0;


$hari = $tgl[0];
$bulan = $tgl[1];
$tahun = $tgl[2];
$hour = $jam[0];
$menit = $jam[1];

$tgl_jadi = $tahun."-".$bulan."-".$hari;
$jam_jadi = $hour.":".$menit.":00";

$set = array('lama_waktu'=>$input_id_lama_waktu, 'aktif_bahas'=>$input_aktif_bahas);
$where = array('id_bank_soal_ujian'=>$input_id_bank_soal);
$proses = $conn->update('bank_soal_ujian_tabel', $set, $where);

//Cek tgl aktif
$cek_ada = $conn->fetch("SELECT a.id_bank_soal_ujian FROM aktivasi_bank_soal AS a WHERE a.id_bank_soal_ujian='$input_id_bank_soal'");
$nums_cek = count($cek_ada);
if($nums_cek > 0){
    $set = array('tanggal_aktif'=>$tgl_jadi, 'jam_aktif'=>$jam_jadi, 'fullscreen'=>$input_fullscreen, 'block_text'=>$input_block_text, 'focus'=>$input_focus);
    $where = array('id_bank_soal_ujian'=>$input_id_bank_soal);
    $proses1 = $conn->update('aktivasi_bank_soal', $set, $where);
}else{
    $values = array('id_bank_soal_ujian'=>$input_id_bank_soal, 'tanggal_aktif'=>$tgl_jadi, 'jam_aktif'=>$jam_jadi, 'fullscreen'=>$input_fullscreen, 'block_text'=>$input_block_text, 'focus'=>$input_focus);
    $proses1 = $conn->insert('aktivasi_bank_soal', $values);
}

if($proses && $proses1){
	if($input_id_lama_waktu > 0){
        $pesan = 'Bank Soal diaktifkan !';
	}else{
        $pesan = 'Bank Soal dinonaktifkan !';
	}
}else{
    $pesan = 'Gagal Update !';
}
?>
<script>
            window.top.window.hasil_simpan('<?php echo $pesan; ?>');
        </script>