<?php
$id_guru = $_SESSION['id_usernya'];
if($level == 1){
$query_mapel = "
				SELECT
				mapel_tabel.id_mapel,
				mapel_tabel.nama_mapel,
				mapel_tabel.tingkat
				FROM mapel_tabel
				";
}else if($level == 2){
	$query_mapel = "
				SELECT
				mapel_guru_tabel.id_guru,
				mapel_tabel.id_mapel,
				mapel_tabel.nama_mapel,
				mapel_tabel.tingkat
				FROM
				mapel_guru_tabel
				INNER JOIN mapel_tabel ON mapel_guru_tabel.id_mapel = mapel_tabel.id_mapel
				WHERE id_guru='$id_guru'
				";
}

$proses_query_mapel = $conn->fetch($query_mapel);
?>
<select name="input_id_mapel" id="input_id_mapel" class="form-control" style="width:100%" required>
	<option value="">--Pilih Mapel--</option>
	<?php
		$nums_mapel = count($proses_query_mapel);
		if($nums_mapel > 0){
			foreach ($proses_query_mapel as $key => $result_mapel) {
			?>
			<option value="<?php echo $result_mapel['id_mapel'] ?>"><?php echo $result_mapel['nama_mapel']; ?></option>
			<?php
			$mapelnya = $result_mapel['id_mapel'];
			$kelas = $result_mapel['tingkat'];
			}
		}else{
			echo "User Ini Tidak Memiliki Mata Pelajaran !";
		}
	?>
</select>