<?php
//----------------------------------------------
require "../../../../config/classDB.php";
$conn = new Database();
//----------------------------------------------
?>
<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
	<div class="panel panel-default">
		<div class="panel-body">
			<div id="divid_show_siswa" class="form-group">
				<label for="input_show_siswa">Tampilkan siswa :</label>
				<select name="input_show_siswa" id="input_show_siswa" class="form-control" onchange="load_siswa();">
					<option value="all">Semua</option>
					<option value="have">Sudah punya kelas</option>
					<option value="havenot">Belum punya kelas</option>
				</select>
			</div>
		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-body">
			<div id="divid_tingkat" class="form-group">
				<label for="input_tingkat">Tingkat</label>
				<select name="input_tingkat" id="input_tingkat" class="form-control" onchange="load_siswa();">
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
			<div id="divid_id_nama_kelas" class="form-group">
				<label for="input_nama_kelas">Nama Kelas</label>
				<input type="text" class="form-control" id="input_nama_kelas" name="input_nama_kelas">
			</div>
			<div id="divid_id_tapel" class="form-group">
				<label for="input_id_tapel">Tahun Ajaran</label>
				<select name="input_id_tapel" id="input_id_tapel" class="form-control">
					<?php
					$q_tapel = $conn->fetch("SELECT * FROM tahun_ajaran_tabel ORDER BY id_tahun_ajaran DESC");
					foreach ($q_tapel as $key => $r_tapel) {
						
						?><option value="<?php echo $r_tapel['id_tahun_ajaran']; ?>"><?php echo $r_tapel['tahun_ajaran']; ?></option><?php
					}
					?>
				</select>
			</div>
			<div id="divid_id_guru" class="form-group">
				<label for="input_id_guru">Guru</label>
				<select name="input_id_guru" id="input_id_guru" class="form-control">
					<option value="">--Pilih--</option>
					<?php
					$q_guru = $conn->fetch("SELECT * FROM guru_tabel WHERE nomor <> 'admin'");
					foreach ($q_guru as $key => $r_guru) {
						$id_guru = $r_guru['id_guru'];
						$cek_exists = $conn->fetch("SELECT * FROM draft_kelas_tabel WHERE id_guru='$id_guru'");
						if(count($cek_exists) > 0){
							continue;
						}else{
							?><option value="<?php echo $r_guru['id_guru']; ?>"><?php echo $r_guru['nama_guru']; ?></option><?php	
						}
						
					}
					?>
				</select>
			</div>
		</div>
	</div>
	
</div>
<div class="col-xs-12 col-sm-12 col-md-9 col-lg-9" id="div_siswa">
	
	
</div>


<script>
	function load_siswa(){
        $.ajax({
            url: 'app/pages/models/kelas/load_siswa.php',
            data: {
            	show_siswa : $("#input_show_siswa").val(),
                tingkat : $("#input_tingkat").val()
            },
            success: function(data){
                $("#div_siswa").html(data);
            },
            error: function(xhr){
                alert("gagal");
            }
        });
    }
</script>
	
