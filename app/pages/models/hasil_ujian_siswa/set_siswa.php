<?php
//----------------------------------------------
require "../../../../config/classDB.php";
$conn = new Database();
//----------------------------------------------

$que_tapel = $conn->fetch("SELECT * FROM tahun_ajaran_tabel ORDER BY id_tahun_ajaran DESC");
$que_nama_ujian = $conn->fetch("SELECT * FROM nama_ujian_tabel ORDER BY id_nama_ujian ASC");
$que_jurusan = $conn->fetch("SELECT * FROM jurusan_tabel WHERE jurusan<>'Semua'");
?>
<div id="divid_tapel" class="form-group">
    <label id="label_id_tapel">Tahun Ajaran</label>
	<select class="form-control" id="input_id_tapel" name="input_id_tapel" onchange="load_list_siswa();">
        <?php
        foreach ($que_tapel as $key => $tapel) {
        	?><option value="<?php echo $tapel['id_tahun_ajaran'] ?>"><?php echo $tapel['tahun_ajaran'] ?></option><?php
        }
        ?>
    </select>
</div>
<div id="divid_semester" class="form-group">
    <label id="label_id_semester">Semester</label>
	<select class="form-control" id="input_id_semester" name="input_id_semester" onchange="load_list_siswa();">
        <option value="GANJIL">GANJIL</option>
        <option value="GENAP">GENAP</option>
    </select>
</div>
<div id="divid_namaujian" class="form-group">
    <label id="label_id_namaujian">Nama Ujian</label>
	<select class="form-control" id="input_id_namaujian" name="input_id_namaujian" onchange="load_list_siswa();">
        <?php
        foreach ($que_nama_ujian as $key => $ujian) {
        	?><option value="<?php echo $ujian['id_nama_ujian'] ?>"><?php echo $ujian['nama_ujian'] ?></option><?php
        }
        ?>
    </select>
</div>
<div id="divid_tingkat" class="form-group">
    <label id="label_id_tingkat">Tingkat</label>
    <select class="form-control" id="input_id_tingkat" name="input_id_tingkat" onchange="load_list_siswa();">
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
            <option value="XII" selected>XII</option>
    </select>
</div>
<div id="divid_jurusan" class="form-group">
    <label id="label_id_jurusan">Jurusan</label>
	<select class="form-control" id="input_id_jurusan" name="input_id_jurusan" onchange="load_list_siswa();">
        <?php
        foreach ($que_jurusan as $key => $jurusan) {
        	?><option value="<?php echo $jurusan['id_jurusan'] ?>"><?php echo $jurusan['jurusan'] ?></option><?php
        }
        ?>
    </select>
</div>