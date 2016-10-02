<?php
//----------------------------------------------
require "../../../../config/classDB.php";
$conn = new Database();
//----------------------------------------------
$id_kelas = $_POST['id_kelas'];
$proses1 = $conn->fetch("
			SELECT DISTINCT
			kelas_tabel.tingkat,
			kelas_tabel.kelas,
			guru_tabel.nama_guru
			FROM
			draft_kelas_tabel
			INNER JOIN kelas_tabel ON draft_kelas_tabel.id_kelas = kelas_tabel.id_kelas
			INNER JOIN guru_tabel ON draft_kelas_tabel.id_guru = guru_tabel.id_guru
			WHERE kelas_tabel.id_kelas = '$id_kelas'
			");

$NamaKelas = $proses1[0]['tingkat']." ".$proses1[0]['kelas'];
$Guru = $proses1[0]['nama_guru'];
?>
<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
	<div class="panel panel-default">
		<div class="panel-body">
			<div class="form-group">
				<label for="nama_kelas">Kelas</label>
				<input type="text" class="form-control" id="nama_kelas" name="nama_kelas" value="<?php echo $NamaKelas; ?>" disabled="true">
			</div>
			<div class="form-group">
				<label for="guru">Guru</label>
				<input type="text" class="form-control" id="guru" name="guru" value="<?php echo $Guru; ?>" disabled="true">
			</div>
		</div>
	</div>
</div>
<div class="col-xs-12 col-sm-12 col-md-9 col-lg-9" id="div_siswa">
	<label>Siswa</label>
	<table id="tblSiswaview" class="table table-hover table-bordered table-striped">
		<thead>
			<tr>
				<th width="20%">NIS</th>
				<th width="60%">Nama</th>
				<th width="10%">Tingkat</th>
				<th width="10%">Jurusan</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$proses2 = $conn->fetch("SELECT
						s.nomor,
						s.nama_siswa,
						s.kelas,
						j.jurusan
						FROM
						draft_kelas_tabel AS dk
						INNER JOIN siswa_tabel AS s ON dk.id_siswa = s.id_siswa
						INNER JOIN jurusan_tabel AS j ON s.id_jurusan = j.id_jurusan
						WHERE dk.id_kelas = '$id_kelas'
						");
			foreach ($proses2 as $key => $data) {
				?>
				<tr>
					<td><?php echo $data['nomor']; ?></td>
					<td><?php echo $data['nama_siswa']; ?></td>
					<td><?php echo $data['kelas']; ?></td>
					<td><?php echo $data['jurusan']; ?></td>
				</tr>
				<?php
			}
			?>
		</tbody>
	</table>
</div>

<script src="plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>

<script>$("#tblSiswaview").dataTable({ "bSort": false });</script>