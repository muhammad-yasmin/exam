<?php
$query_nama_ujian = "SELECT nama_ujian_tabel.* FROM nama_ujian_tabel ORDER BY id_nama_ujian";
$proses_nama_ujian = $conn->fetch($query_nama_ujian);
?>
<div id="divid_nama_ujian" class="form-group">
    <label id="label_id_nama_ujian">Nama Ujian</label>
	<select class="form-control" id="input_id_nama_ujian" name="input_id_nama_ujian">
	<?php
		$nums_nama_ujian = count($proses_nama_ujian);
		if($nums_nama_ujian > 0){
			foreach ($proses_nama_ujian as $key => $data_nama_ujian) {
	        	?>
				<option value="<?php echo $data_nama_ujian['id_nama_ujian']; ?>"><?php echo $data_nama_ujian['nama_ujian']; ?></option>
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