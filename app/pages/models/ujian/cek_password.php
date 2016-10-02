<?php
//----------------------------------------------
require "../../../../config/classDB.php";
$conn = new Database();
//----------------------------------------------

$id_user = $_POST['input_id_user'];
$id_bank = $_POST['input_id_bank'];

if(isset($_POST['check_syarat'])){
	
	$password_soal = md5("bank".$_POST['input_pass_soal']);

	$query = "SELECT * FROM bank_soal_ujian_tabel WHERE id_bank_soal_ujian=$id_bank AND password_bank='$password_soal'";
	$proses = $conn->fetch($query);
	$nums = count($proses);
	if($nums == 1){
		$set = array("ujian"=>$id_bank);
		$where = array("nomor_user"=>$_SESSION['no_user']);
		$registrasi_ujian = $conn->update("log_activities", $set, $where);

		$kondisi = "benar";
		$pesan = "oke";
	}else{
		$kondisi = "salah";
		$pesan = "Maaf, Password Salah !";
	}
}else{
	$kondisi = "salah";
	$pesan = "Anda belum menyetujui persyaratan ujian !";
}

$cek_full = $conn->fetch("SELECT fullscreen FROM aktivasi_bank_soal WHERE id_bank_soal_ujian='$id_bank'");

foreach ($cek_full as $key => $val) {
	$fullscreen = $val['fullscreen'];
}

?>
<script>window.top.window.hasil_cek('<?php echo $kondisi; ?>','<?php echo $fullscreen; ?>',<?php echo $id_bank; ?>,'<?php echo $pesan; ?>');</script>