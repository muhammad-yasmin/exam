<?php
if($level == 1){
	$query_jurusan = "
	SELECT
	j.id_jurusan,
	j.jurusan
	FROM jurusan_tabel j
	";
}else if($level == 2){
	$query_jurusan = "
	SELECT
	j.id_jurusan,
	j.jurusan
	FROM
	guru_jurusan_tabel AS gj
	INNER JOIN jurusan_tabel AS j ON gj.id_jurusan = j.id_jurusan
	WHERE gj.id_guru = $id_guru
	";
}

$proses_jurusan = $conn->fetch($query_jurusan);
?>
<div id="divid_jurusan" class="form-group">
    <label id="label_id_jurusan">Jurusan</label>
	<select class="form-control" id="input_id_jurusan" name="input_id_jurusan">
	<?php
		$nums_jurusan = count($proses_jurusan);
		if($nums_jurusan > 0){
			foreach ($proses_jurusan as $key => $data_jurusan) {
	        	?>
				<option value="<?php echo $data_jurusan['id_jurusan']; ?>"><?php echo $data_jurusan['jurusan']; ?></option>
	        	<?php
	        }
		}else{
			?>
				<option value="">Tidak Ada Data</option>
	        <?php
		}
	?>
    </select>
</div>