<?php
//----------------------------------------------
require "../../../../config/classDB.php";
$conn = new Database();
//----------------------------------------------
$level = $_SESSION['level_nya'];
$id_guru = $_SESSION['id_usernya'];
?>
<input type="hidden" id="input_id_guru" name="input_id_guru" value="<?php echo $id_guru; ?>">

    <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
	    <div class="panel panel-default">
	    	<div class="panel-body">
	    		<div id="divid_nama_bank" class="form-group">
				    <label for="input_nama_bank">Nama Bank</label>
					<input type="text" id="input_nama_bank" name="input_nama_bank" class="form-control">
				</div>
	    	   <?php
				require "load_tapel.php";
				?>
				<div id="divid_semester" class="form-group">
				    <label id="label_id_semester">Semester</label>
					<select class="form-control" id="input_id_semester" name="input_id_semester">
				        <option value="GANJIL">GANJIL</option>
				        <option value="GENAP">GENAP</option>
				    </select>
				</div>
				<?php 
				require "load_nama_ujian.php";
				//require "load_tingkat.php";
				?>
				<div id="divid_tingkat" class="form-group">
				    <label id="label_id_tingkat">Tingkat</label>
					<select class="form-control" id="input_id_tingkat" name="input_id_tingkat">
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
				require "load_jurusan.php";
				?>
				<div id="divid_kkm" class="form-group">
					<label for="input_id_kkm">Nilai KKM</label>
					<input type="number" id="input_id_kkm" name="input_id_kkm" class="form-control" min="0" max="100">
				</div>
				<div id="divid_pass_bank" class="form-group">
					<label for="input_id_pass_bank">Password</label>
					<input type="password" id="input_id_pass_bank" name="input_id_pass_bank" class="form-control">
				</div>
	    	</div>
	    </div>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
		<div id="pilih_mapel">
			<a href="#collapse_mapel" class="btn btn-primary btn-xs" data-toggle="collapse">Pilih Mapel</a>
			<div id="collapse_mapel" class="collapse">
				<div class="form-group">
					<input type="text" id="cari_mapel" name="cari_mapel" placeholder="Cari" class="form-control" onkeyup="load_btn_mapel();">
				</div>
				<div id="load_btn_mapel"></div>
			</div>
			<input type="hidden" id="input_id_mapel" name="input_id_mapel">
		</div>
		<div id="div_kartu_soal"></div>
	</div>