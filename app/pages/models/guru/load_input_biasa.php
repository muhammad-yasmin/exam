<?php
//----------------------------------------------
require "../../../../config/classDB.php";
$conn = new Database();
//----------------------------------------------
?>
<div class="row">
	<div id="div_col_img" class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
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
    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
		<div id="divid_nip" class="form-group">
			<label for="input_id_nip">NIP</label>
			<input type="text" class="form-control" id="input_id_nip" name="input_id_nip" maxlength="18" autocomplete="off">
			<button type="button" class="btn btn-flat btn-xs" id="pesan_nip" style="display:none;"></button>
		</div>
		<div id="divid_nama_guru" class="form-group">
			<label for="input_id_nama_guru">Nama Guru</label>
			<input type="text" class="form-control" id="input_id_nama_guru" name="input_id_nama_guru" autocomplete="off">
		</div>
		<div id="divid_jk" class="form-group">
			<label for="input_id_jk">Jenis Kelamin</label>
			<select name="input_id_jk" id="input_id_jk" class="form-control">
				<option value="">--Pilih--</option>
				<option value="LAKI-LAKI">LAKI-LAKI</option>
				<option value="PEREMPUAN">PEREMPUAN</option>
			</select>
		</div>
		<?php
		$que_jurusan = $conn->fetch("SELECT * FROM jurusan_tabel");
		?>
		<div id="divid_jurusan" class="form-group" style="display:none;">
			<label for="input_id_jurusan">Jurusan</label>
			<select name="input_id_jurusan" id="input_id_jurusan" class="form-control">
				<option value="-">--Pilih--</option>
				<?php
				foreach ($que_jurusan as $key => $jurusan) {
					?><option value="<?php echo $jurusan['id_jurusan'] ?>"><?php echo $jurusan['jurusan'] ?></option><?php
				}
				?>
			</select>
		</div>
		<div id="divid_password" class="form-group" style="display: none;">

			<div class="checkbox">
				<label>
					<input type="checkbox" name="cek_ganti_pass" value="<?php echo md5('passguruword'); ?>">
					Ganti Password ke default
				</label>
			</div>
		</div>
		
	</div>
	<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
		<div id="div_pilih_mapel"></div>
	</div>
</div>