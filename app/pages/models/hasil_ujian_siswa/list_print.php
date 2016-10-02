<?php 
$que_tapel = mysql_query("SELECT * FROM tahun_ajaran_tabel WHERE id_tahun_ajaran=$p_tapel");
$que_nama_ujian = mysql_query("SELECT * FROM nama_ujian_tabel WHERE id_nama_ujian=$p_nama_ujian");
$que_jurusan = mysql_query("SELECT * FROM jurusan_tabel WHERE id_jurusan=$p_jurusan");
$r_tapel = mysql_fetch_assoc($que_tapel);
$r_nama_ujian = mysql_fetch_assoc($que_nama_ujian);
$r_jurusan = mysql_fetch_assoc($que_jurusan);
?>
<div style="text-align:center;">
	<h4>Nilai Hasil <?php echo $r_nama_ujian['nama_ujian']." Semester ".$p_semester." ".$r_tapel['tahun_ajaran']; ?><br>Kelas : <?php echo $r_jurusan['jurusan']; ?></h4>
</div>