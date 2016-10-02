<?php
$query_tapel = "SELECT * FROM tahun_ajaran_tabel ORDER BY id_tahun_ajaran DESC";
$proses_query_tapel = $conn->fetch($query_tapel);
?>

<select name="input_id_tapel" id="input_id_tapel" class="form-control" required>
		<?php
		$nums_tapel = count($proses_query_tapel);
		if($nums_tapel > 0){
			foreach ($proses_query_tapel as $key => $result_tapel) {
			?>
			<option value="<?php echo $result_tapel['id_tahun_ajaran'] ?>"><?php echo $result_tapel['tahun_ajaran']; ?></option>
			<?php
			}
		}
	?>
</select>