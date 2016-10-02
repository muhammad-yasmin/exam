<?php
$query_tingkat = "
	SELECT DISTINCT
	mg.id_guru,
	m.id_mapel,
	m.tingkat
	FROM
	mapel_guru_tabel AS mg
	INNER JOIN mapel_tabel AS m ON mg.id_mapel = m.id_mapel
	WHERE mg.id_guru = $id_guru
	";
$proses_tingkat = $conn->fetch($query_tingkat);
?>
<div id="divid_tingkat" class="form-group">
    <label id="label_id_tingkat">Tingkat</label>
	<select class="form-control" id="input_id_tingkat" name="input_id_tingkat">
	<?php
		$nums_tingkat = count($proses_tingkat);
		if($nums_tingkat > 0){
			foreach ($proses_tingkat as $key => $data_tingkat) {
	        	?>
				<option value="<?php echo $data_tingkat['tingkat']; ?>"><?php echo $data_tingkat['tingkat']; ?></option>
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