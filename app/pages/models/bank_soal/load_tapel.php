<?php
$query_tapel = "SELECT tapel.* FROM tahun_ajaran_tabel as tapel ORDER BY id_tahun_ajaran DESC";
$proses_tapel = $conn->fetch($query_tapel);
?>
<div id="divid_tapel" class="form-group">
    <label id="label_id_tapel">Tahun Ajaran</label>
	<select class="form-control" id="input_id_tapel" name="input_id_tapel">
	<?php
		$nums_tapel = count($proses_tapel);
		if($nums_tapel > 0){
			foreach ($proses_tapel as $key => $data_tapel) {
	        	?>
				<option value="<?php echo $data_tapel['id_tahun_ajaran']; ?>"><?php echo $data_tapel['tahun_ajaran']; ?></option>
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