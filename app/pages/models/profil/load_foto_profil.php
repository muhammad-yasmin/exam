<?php
//----------------------------------------------
require "../../../../config/classDB.php";
$conn = new Database();
//----------------------------------------------

$id_user = $_SESSION['id_usernya'];
$level = $_SESSION['level_nya'];

if($level == 1 || $level == 2){
	$query = "SELECT guru_tabel.foto FROM guru_tabel WHERE id_guru = '$id_user'";
	$proses = $conn->fetch($query);
	foreach ($proses as $key => $data) {
		$FOTO = $data['foto'];
	}
}else{
	$query = "SELECT siswa_tabel.foto FROM siswa_tabel WHERE id_siswa = '$id_user'";
	$proses = $conn->fetch($query);
	foreach ($proses as $key => $data) {
		$FOTO = $data['foto'];
	}
}
?>
<img src="<?php echo $FOTO; ?>" height="200" width="200" class="img-circle"><br>
<span>Upload foto lain</span><br>
<div class="panel panel-default">
	<div class="panel-body">
		<input type="file" name="input_id_foto" id="input_id_foto">
	</div>
</div>
