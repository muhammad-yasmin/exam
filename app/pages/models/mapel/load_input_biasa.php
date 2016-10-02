<?php 
//----------------------------------------------
require "../../../../config/classDB.php";
$conn = new Database();
//----------------------------------------------
$query_jurusan = $conn->fetch("SELECT * FROM jurusan_tabel");
?>
<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-md-offset-3 col-lg-offset-3">
	

	<div id="divid_kelompok" class="form-group">
		<label for="input_id_kelompok">Kelompok Mata Pelajaran</label>
		<select name="input_id_kelompok" id="input_id_kelompok" class="form-control">
			<option value="">--Pilih--</option>
			<option value="A">A</option>
			<option value="B">B</option>
			<option value="C">C</option>
		</select>
	</div>
	<div id="divid_kode_mapel" class="form-group">
		<label for="input_id_kode_mapel">Kode Mata Pelajaran</label>
		<input type="text" class="form-control" id="input_id_kode_mapel" name="input_id_kode_mapel" autocomplete="off">
	</div>
	<div id="divid_nama_mapel" class="form-group">
		<label for="input_id_nama_mapel">Nama Mata Pelajaran</label>
		<input type="text" class="form-control" id="input_id_nama_mapel" name="input_id_nama_mapel" autocomplete="off">
	</div>
	<div id="divid_tingkat" class="form-group">
		<label for="input_id_tingkat">Tingkat</label>
		<select name="input_id_tingkat" id="input_id_tingkat" class="form-control" onchange="satuan_pendidikan();">
			<option value="">--Pilih--</option>
			<option value="I">I</option>
			<option value="II">II</option>
			<option value="III">III</option>
			<option value="IV">IV</option>
			<option value="V">V</option>
			<option value="VI">VI</option>
			<option value="VII">VII</option>
			<option value="VIII">VIII</option>
			<option value="IX">IX</option>
			<option value="X">X</option>
			<option value="XI">XI</option>
			<option value="XII">XII</option>
		</select>
	</div>
	<div id="divid_pendidikan" class="form-group" style="display: none;">
		<label for="input_id_pendidikan">Satuan Pendidikan</label>
		<select name="input_id_pendidikan" id="input_id_pendidikan" class="form-control">
			<option value="">--Pilih--</option>
			<option value="SMA / MA">SMA / MA</option>
			<option value="SMK / MAK">SMK / MAK</option>
		</select>
	</div>
	<div id="divid_jurusan" class="form-group">
		<label for="input_id_jurusan">Untuk Jurusan</label>
		<select name="input_id_jurusan" id="input_id_jurusan" class="form-control">
			<option value="">--Pilih--</option>
			<?php
			foreach ($query_jurusan as $key => $rj) {
				?>
				<option value="<?php echo $rj['id_jurusan']; ?>"><?php echo $rj['jurusan']; ?></option>
				<?php
			}
			?>
		</select>
	</div>

	<div class="row">
        <div id="pesan_alert_form" style="display:none;">
            <div class="alert alert-danger">
                <p id="isi_pesan_alert_form">isi...</p>
            </div>
        </div>
    </div>
    
</div>

<script>
	function satuan_pendidikan(){
		var tingkat = $("#input_id_tingkat").val();
		if(tingkat == 'X' || tingkat == 'XI' || tingkat == 'XII'){
			$("#divid_pendidikan").show();
		}else{
			$("#divid_pendidikan").hide();
		}
	}
</script>