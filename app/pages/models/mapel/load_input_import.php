	
	<?php
	//----------------------------------------------
	require "../../../../config/classDB.php";
	$conn = new Database();
	//----------------------------------------------
	?>

	<div id="divid_id_download" class="form-group">
		<label for="a_id_download">Download Format .xls</label><br>
		<a id="a_id_download"  href="dist/file/format_excel/import_mata_pelajaran.xls" target="_blank" class="btn btn-xs btn-warning"><i class="fa fa-download"></i> Download disini..</a>
	</div>
	 <div id="divid_id_import" class="form-group">
			<label for="input_id_import">Import</label>
			<input type="file" class="form-control" id="input_id_import" name="input_id_import">
	</div>

	<div id="keterangan" class="form-group">
		<?php
		$query_jurusan = $conn->fetch("SELECT j.id_jurusan, j.jurusan FROM jurusan_tabel j ORDER BY j.id_jurusan ASC");
		?>
		<label>Keterangan</label><br>
		<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th width="20%">ID</th>
						<th width="80%">Jurusan</th>
					</tr>
				</thead>
				<tbody>
					<?php
					foreach ($query_jurusan as $key => $val) {
						?>
						<tr>
							<td><?php echo $val['id_jurusan']; ?></td>
							<td><?php echo $val['jurusan']; ?></td>
						</tr>
						<?php
					}
					?>
				</tbody>
			</table>
		</div>
		</div>

		
	</div>