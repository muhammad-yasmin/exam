<?php
//----------------------------------------------
require "../../../../config/classDB.php";
$conn = new Database();
//----------------------------------------------

$p_tapel = $_POST['tapel'];
$p_semester = $_POST['semester'];
$p_nama_ujian = $_POST['ujian'];
$p_jurusan = $_POST['jurusan'];
$p_tingkat = $_POST['tingkat'];
$p_mapel = $_POST['mapel'];
$p_kelas = $_POST['kelas'];

$queryMapel = $conn->fetch("SELECT m.nama_mapel FROM mapel_tabel m WHERE m.id_mapel='$p_mapel'");



$querySiswa = $conn->fetch("SELECT dkls.id_siswa, s.nomor, s.nama_siswa 
					FROM draft_kelas_tabel AS dkls 
					INNER JOIN siswa_tabel AS s ON dkls.id_siswa = s.id_siswa
					WHERE dkls.id_kelas='$p_kelas'
");
?>
<label>
<?php
foreach ($queryMapel as $key => $M) {
	echo $M['nama_mapel'];
}
?></label>
<div class="table-responsive">
		<table id="tabel_nilai" class="table table-hover table-bordered">
			<thead>
				<tr>
					<th width="100px">NIS</th>
					<th>Nama</th>
					<th width="100px">Nilai</th>
				</tr>
			</thead>
			<tbody>
				<?php
				foreach ($querySiswa as $key => $Siswa) {
					$IdSiswa = $Siswa['id_siswa'];
					?>
					<tr>
						<td align="center"><?php echo $Siswa['nomor']; ?></td>
						<td><?php echo $Siswa['nama_siswa']; ?></td>
						<td align="center">
							<?php

							$queryNilai = $conn->fetch("SELECT
											bh.skor_nilai
											FROM
											bank_hasil_ujian_tabel AS bh
											INNER JOIN bank_soal_ujian_tabel AS bs ON bh.id_bank_soal_ujian = bs.id_bank_soal_ujian
											WHERE 
											bh.id_siswa = '$IdSiswa' AND
											bs.id_tahun_ajaran = '$p_tapel' AND
											bs.semester = '$p_semester' AND
											bs.id_nama_ujian = '$p_nama_ujian' AND
											bs.tingkat = '$p_tingkat' AND
											bs.id_mapel = '$p_mapel'");
							$numsNilai = count($queryNilai);
							foreach ($queryNilai as $key => $Tampil) {
								echo ($numsNilai > 0)? $Tampil['skor_nilai'] : "-";
							}
							
							?>
						</td>
					</tr>
					<?php
				}
				?>
			</tbody>
		</table>
	</div>	

<script src="plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>

<script>$("#tabel_nilai").dataTable({ "bSort": false });</script>