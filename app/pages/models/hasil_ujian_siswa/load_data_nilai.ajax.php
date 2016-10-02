<?php
//----------------------------------------------
require "../../../../config/classDB.php";
$conn = new Database();
//----------------------------------------------

$id_siswa = $_POST['id_siswa'];
$id_tapel = $_POST['tapel'];
$tingkat = $_POST['tingkat'];
$semester = $_POST['semester'];
$id_namaujian = $_POST['namaujian'];

$query_siswa = $conn->fetch("SELECT s.id_siswa, s.nomor, s.nama_siswa, s.kelas, s.id_jurusan, j.jurusan FROM siswa_tabel AS s INNER JOIN jurusan_tabel AS j ON s.id_jurusan = j.id_jurusan WHERE s.id_siswa='$id_siswa'");

foreach ($query_siswa as $key => $Siswa) {
	$NIS = $Siswa['nomor'];
	$Nama = $Siswa['nama_siswa'];
	$Jurusan = $Siswa['jurusan'];
	$KelasSiswa = $Siswa['kelas'];
}


$query_tapel = $conn->fetch("SELECT t.tahun_ajaran FROM tahun_ajaran_tabel t WHERE t.id_tahun_ajaran='$id_tapel'");
foreach ($query_tapel as $key => $Tapel) {
	$Ajaran = $Tapel['tahun_ajaran'];
}


$list_tingkat = array(
	'I' => '1','II' => '2','III' => '3','IV' => '4','V' => '5','VI' => '6',
	'VII' => '1','VIII' => '2','IX' => '3',
	'X' => '1','XI' => '2','XII' => '3'
);

$TahunKe = $list_tingkat[$tingkat];
$Semester = ($semester == "GANJIL")? 1 : 2;

$query_namaujian = $conn->fetch("SELECT n.nama_ujian FROM nama_ujian_tabel n WHERE n.id_nama_ujian='$id_namaujian'");
foreach ($query_namaujian as $key => $N) {
	$NamaUjian = $N['nama_ujian'];
}


$KelompokMapel = ['A','B','C'];
?>

<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" align="center"><b>Nilai Hasil <?php echo $NamaUjian; ?></b></div>
	<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
		<table width="100%">
			<tr><td>Nama</td><td>:</td><td><?php echo $Nama; ?></td></tr>
			<tr><td>NIS</td><td>:</td><td><?php echo $NIS; ?></td></tr>
			<tr><td>Jurusan</td><td>:</td><td><?php echo $Jurusan; ?></td></tr>
		</table>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 col-lg-offset-4">
		<table width="100%">
			<tr><td>Tahun Ajaran</td><td>:</td><td><?php echo $Ajaran; ?></td></tr>
			<tr><td>Tingkat/Tahun Ke</td><td>:</td><td><?php echo $TahunKe; ?></td></tr>
			<tr><td>Semester/Kelas</td><td>:</td><td><?php echo $Semester."/".$TahunKe; ?></td></tr>
		</table>
	</div>
</div>
<div class="row container">
	<div class="table-responsive">
		<table class="table table-hover table-bordered">
			<thead>
				<tr>
					<th colspan="2">Mata Pelajaran</th>
					<th width="100px">Nilai</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$no = 1;
				foreach ($KelompokMapel as $key => $KelMap) {
					?>
					<tr>
						<td colspan="3"><b>Kelompok <?php echo $KelMap; ?></b></td>
					</tr>
					<?php
					$q = $conn->fetch("SELECT km.nama_kelompok_mapel, m.id_mapel, m.nama_mapel, m.tingkat FROM kelompok_mapel_tabel AS km INNER JOIN mapel_tabel AS m ON km.id_mapel = m.id_mapel WHERE km.nama_kelompok_mapel='$KelMap' AND m.tingkat='$KelasSiswa'");
					foreach ($q as $key => $Nilai) {
						?>
						<tr>
							<td width="10px" align="center"><?php echo $no; ?></td>
							<td><?php echo $Nilai['nama_mapel']; ?></td>
							<td align="center">
								<?php
								$IdMapel = $Nilai['id_mapel'];
								$qNilai = $conn->fetch("SELECT
											bh.skor_nilai
											FROM
											bank_hasil_ujian_tabel AS bh
											INNER JOIN bank_soal_ujian_tabel AS bs ON bh.id_bank_soal_ujian = bs.id_bank_soal_ujian
											WHERE 
											bh.id_siswa = '$id_siswa' AND
											bs.id_tahun_ajaran = '$id_tapel' AND
											bs.semester = '$semester' AND
											bs.id_nama_ujian = '$id_namaujian' AND
											bs.tingkat = '$tingkat' AND
											bs.id_mapel = '$IdMapel'
											");
								$numsNilai = count($qNilai);
								foreach ($qNilai as $key => $Tampil) {
									echo ($numsNilai > 0)? $Tampil['skor_nilai'] : "-";
								}
								?>
							</td>
						</tr>
						<?php
						$no++;
					}
				}
				?>
			</tbody>
		</table>
	</div>
</div>