<?php
//----------------------------------------------
require "../../../../config/classDB.php";
$conn = new Database();
//----------------------------------------------
$input_nama_bank = $_POST['input_nama_bank'];
$input_id_guru = $_POST['input_id_guru'];
$input_id_tapel = $_POST['input_id_tapel'];
$input_id_semester = $_POST['input_id_semester'];
$input_id_nama_ujian = $_POST['input_id_nama_ujian'];
$input_id_tingkat = $_POST['input_id_tingkat'];
$input_id_jurusan = $_POST['input_id_jurusan'];
$input_id_jml_soal = count($_POST['input_id_kartu']);
$input_id_lama_waktu = 0;
$input_id_mapel = $_POST['input_id_mapel'];
$input_id_kkm = $_POST['input_id_kkm'];
$input_pass_bank = md5("bank".$_POST['input_id_pass_bank']);


$select_bank = $conn->fetch('SELECT id_bank_soal_ujian FROM bank_soal_ujian_tabel ORDER BY id_bank_soal_ujian DESC LIMIT 0,1');
$count = count($select_bank);
if($count > 0){
	foreach ($select_bank as $key => $result_select) {
		$id_bank = $result_select['id_bank_soal_ujian'] + 1;
	}
}else{
	$id_bank = 1;
}


foreach ($_POST['input_id_kartu'] as $kartu) {
	//select_kd = $conn->fetch("SELECT id_kompetensi_dasar FROM draft_kartu_tabel WHERE id_kartu_soal='$kartu'");
	$select_kd = $conn->fetch("SELECT id_kompetensi_dasar FROM draft_kartu_tabel WHERE id_kartu_soal='$kartu'");
	$id_kd = $select_kd[0]['id_kompetensi_dasar'];
	$values_soal = array('id_bank_soal_ujian'=>$id_bank, 'id_kartu_soal'=>$kartu, 'id_kompetensi_dasar'=>$id_kd);
	$proses1 = $conn->insert('isi_soal_tabel', $values_soal);
}

$hasil_proses = true;
if($proses1){
	echo "proses1 berhasil";
	$values_bank = array(
					'id_bank_soal_ujian'=>$id_bank,
					'nama_bank_soal_ujian'=>$input_nama_bank,
					'id_guru'=>$input_id_guru,
					'id_tahun_ajaran'=>$input_id_tapel, 
					'semester'=>$input_id_semester, 
					'id_nama_ujian'=>$input_id_nama_ujian, 
					'tingkat'=>$input_id_tingkat,
					'id_jurusan'=>$input_id_jurusan, 
					'jumlah_soal'=>$input_id_jml_soal, 
					'lama_waktu'=>$input_id_lama_waktu, 
					'id_mapel'=>$input_id_mapel, 
					'password_bank'=>$input_pass_bank, 
					'aktif_bahas'=>'tidak');
	//$pesan = $values_bank;
	
	$proses2 = $conn->insert('bank_soal_ujian_tabel', $values_bank);
	if($proses2){
		echo "proses2 berhasil";
		$values3 = array('id_bank_soal_ujian'=>$id_bank, 'nilai_minimal'=>$input_id_kkm);
		$proses3 = $conn->insert('pengaturan_nilai_tabel', $values3);
		if($proses3){
			echo "proses3 berhasil";
			$hasil_proses = true;
		}else{
			echo "proses3 gagal";
			$hasil_proses = false;
		}
	}else{
		echo "proses2 gagal";
		$hasil_proses = false;
	}
}else{
	echo "proses1 gagal";
	$hasil_proses = false;

}

if($hasil_proses == true){
	$pesan = 'Berhasil Tambah Bank Soal !';
}else{
	$pesan = 'Gagal Tambah Bank Soal !';
}
?>
<script>
                window.top.window.hasil_simpan('<?php echo $pesan; ?>');
            </script>