<?php
//----------------------------------------------
require "../../../../config/classDB.php";
$conn = new Database();
//----------------------------------------------
$id_user = $_SESSION['id_usernya'];
$level = $_SESSION['level_nya'];

if($level == 1){
	$que = "SELECT * FROM mapel_tabel";
}else{
	$que = "SELECT
							mg.id_guru,
							m.id_mapel,
							m.kode_mapel,
							m.nama_mapel,
							m.tingkat,
							m.satuan_pendidikan
							FROM
							mapel_guru_tabel AS mg
							INNER JOIN mapel_tabel AS m ON mg.id_mapel = m.id_mapel
							WHERE mg.id_guru = $id_user
							";
}
$que_mapel = $conn->fetch($que);
?>
<input type="hidden" id="input_id_kd" name="input_id_kd" value="-">
<input type="hidden" id="input_id_kd2" name="input_id_kd2" value="-">

<div id="divid_mapel" class="form-group">
	<label for="input_id_mapel">Mata Pelajaran</label>
	<select name="input_id_mapel" id="input_id_mapel" class="form-control">
		<?php
		foreach ($que_mapel as $key => $r_mapel) {
			?><option value="<?php echo $r_mapel['id_mapel']; ?>"><?php echo $r_mapel['nama_mapel']; ?></option><?php
		}
		?>
	</select>
</div>
<div id="divid_kd3" class="form-group">
	<label for="input_text_kd3">Kompetensi Dasar (3.x)</label>
	<textarea rows="5" class="form-control" name="input_text_kd3" id="input_text_kd3"></textarea>
</div>
<div id="divid_kd4" class="form-group">
	<label for="input_text_kd4">Kompetensi Dasar (4.x)</label>
	<textarea rows="5" class="form-control" name="input_text_kd4" id="input_text_kd4"></textarea>
</div>
