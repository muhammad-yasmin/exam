<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
		<div id="show_foto" style="display:none;">
			<a onclick="gantifoto();" style="cursor:pointer;" title="Edit Foto"><img id="img_foto" src="" height="100" width="100" class="img-circle"></a>
		</div>
		<div id="input_foto">
			<div id="divid_foto" class="fileinput fileinput-new" data-provides="fileinput">
				<label>Foto (optional)</label><br>
	            <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 3cm;height:3cm;">
	                <img id="gambarnya" src="">
	            </div>
	            <div>
	                <span class="btn btn-default btn-file btn-flat">
	                    <span class="fileinput-new">Pilih Foto</span>
	                    <span class="fileinput-exists">Ubah</span>
	                    <input type="file" name="input_id_foto" id="input_id_foto">
	                </span>
	                <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Hapus</a>
	            </div>
	        </div>
	    </div>
	</div>
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">		
		<div id="divid_nis" class="form-group">
			<label for="input_id_nis">NIS</label>
			<input type="text" class="form-control" id="input_id_nis" name="input_id_nis">
		</div>
		<div id="divid_nama_siswa" class="form-group">
			<label for="input_id_nama_siswa">Nama Siswa</label>
			<input type="text" class="form-control" id="input_id_nama_siswa" name="input_id_nama_siswa">
		</div>
		<div id="divid_jk" class="form-group">
			<label for="input_id_jk">Jenis Kelamin</label>
			<select name="input_id_jk" id="input_id_jk" class="form-control">
				<option value="">--Pilih--</option>
				<option value="LAKI-LAKI">LAKI-LAKI</option>
				<option value="PEREMPUAN">PEREMPUAN</option>
			</select>
		</div>
		<div id="divid_kelas" class="form-group">
			<label for="input_id_kelas">Kelas</label>
			<select name="input_id_kelas" id="input_id_kelas" class="form-control">
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
		<?php
		//----------------------------------------------
		require "../../../../config/classDB.php";
		$conn = new Database();
		//----------------------------------------------
		$query = "SELECT * FROM jurusan_tabel WHERE id_jurusan>1";
		$proses = $conn->fetch($query);
		?>
		<div id="divid_jurusan" class="form-group">
			<label for="input_id_jurusan">Jurusan</label>
			<select name="input_id_jurusan" id="input_id_jurusan" class="form-control">
				<option value="">--Pilih--</option>
				<?php 
				foreach ($proses as $key => $data) {
					?>
					<option value="<?php echo $data['id_jurusan']; ?>"><?php echo $data['jurusan']; ?></option>
					<?php
				}
				?>
			</select>
		</div>
		<div id="divid_password" class="form-group" style="display: none;">

			<div class="checkbox">
				<label>
					<input type="checkbox" name="cek_ganti_pass" value="<?php echo md5('pass12345word'); ?>">
					Ganti Password ke default
				</label>
			</div>
		</div>
	</div>
	
</div>
<div class="row">
  <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
    <div id="pesan_alert_form" style="display:none;">
        <div class="alert alert-danger">
            <p id="isi_pesan_alert_form">isi...</p>
        </div>
    </div>
  </div>
</div>