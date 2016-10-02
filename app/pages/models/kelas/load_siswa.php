<?php
//----------------------------------------------
require "../../../../config/classDB.php";
$conn = new Database();
//----------------------------------------------

$show_siswa = $_GET['show_siswa'];
$tingkat = $_GET['tingkat'];

if($show_siswa == 'all'){
	$query = $conn->fetch("
		SELECT
		siswa_tabel.id_siswa,
		siswa_tabel.nomor,
		siswa_tabel.nama_siswa,
		siswa_tabel.kelas,
		jurusan_tabel.jurusan
		FROM
		siswa_tabel
		INNER JOIN jurusan_tabel ON siswa_tabel.id_jurusan = jurusan_tabel.id_jurusan
		WHERE siswa_tabel.kelas='$tingkat'
		");
	?>
<label>Siswa</label>
	<table id="tblSiswa" class="table table-hover table-bordered table-striped">
	  <thead>
	      <tr>
	        <th width="10%">Pilih</th>
	        <th width="10%">NIS</th>
	        <th width="60%">Nama</th>
	        <th width="10%">Kelas</th>
	        <th width="10%">Jurusan</th>
	      </tr>
	  </thead>
	  <tbody style="overflow-y:auto;height:30px;">
	  	<?php foreach ($query as $key => $data) { ?>
		<tr>
			<td align="center">
                <input type="checkbox" id="input_id_siswa" name="input_id_siswa[]" value="<?php echo $data['id_siswa']; ?>">
            </td>
			<td><?php echo $data['nomor']; ?></td>
			<td><?php echo $data['nama_siswa']; ?></td>
			<td><?php echo $data['kelas']; ?></td>
			<td><?php echo $data['jurusan']; ?></td>
		</tr>
		<?php } ?>
	  </tbody>
	</table>

	<?php
}else if($show_siswa == 'have'){
	$query = $conn->fetch("
		SELECT
		s.id_siswa,
		s.nomor,
		s.nama_siswa,
		s.kelas as tingkat,
		j.jurusan,
		k.kelas as nama_kelas
		FROM
		draft_kelas_tabel AS dkl
		INNER JOIN siswa_tabel AS s ON dkl.id_siswa = s.id_siswa
		INNER JOIN jurusan_tabel AS j ON s.id_jurusan = j.id_jurusan
		INNER JOIN kelas_tabel AS k ON dkl.id_kelas = k.id_kelas
		WHERE s.kelas='$tingkat'
		");
	?>
<label>Siswa</label>
	<table id="tblSiswa" class="table table-hover table-bordered table-striped">
	  <thead>
	      <tr>
	        <th width="10%">Pilih</th>
	        <th width="10%">NIS</th>
	        <th width="60%">Nama</th>
	        <th width="10%">Kelas</th>
	      </tr>
	  </thead>
	  <tbody style="overflow-y:auto;height:30px;">
	  	<?php foreach ($query as $key => $data) { ?>
		<tr>
			<td align="center">
                <input type="checkbox" id="input_id_siswa" name="input_id_siswa[]" value="<?php echo $data['id_siswa']; ?>">
            </td>
			<td><?php echo $data['nomor']; ?></td>
			<td><?php echo $data['nama_siswa']; ?></td>
			<td><?php echo $data['tingkat']." ".$data['nama_kelas']; ?></td>
		</tr>
		<?php } ?>
	  </tbody>
	</table>

	<?php
}else if($show_siswa == 'havenot'){
	$query = $conn->fetch("
		SELECT
		s.id_siswa,
		s.nomor,
		s.nama_siswa,
		s.kelas,
		j.jurusan
		FROM
		siswa_tabel AS s
		LEFT JOIN draft_kelas_tabel AS dkl ON s.id_siswa = dkl.id_siswa
		INNER JOIN jurusan_tabel AS j ON s.id_jurusan = j.id_jurusan
		WHERE
		dkl.id_siswa IS NULL AND
		s.kelas = '$tingkat'
		");
	?>
<label>Siswa</label>
	<table id="tblSiswa" class="table table-hover table-bordered table-striped">
	  <thead>
	      <tr>
	        <th width="10%">Pilih</th>
	        <th width="10%">NIS</th>
	        <th width="60%">Nama</th>
	        <th width="10%">Kelas</th>
	        <th width="10%">Jurusan</th>
	      </tr>
	  </thead>
	  <tbody style="overflow-y:auto;height:30px;">
	  	<?php foreach ($query as $key => $data) { ?>
		<tr>
			<td align="center">
                <input type="checkbox" id="input_id_siswa" name="input_id_siswa[]" value="<?php echo $data['id_siswa']; ?>">
            </td>
			<td><?php echo $data['nomor']; ?></td>
			<td><?php echo $data['nama_siswa']; ?></td>
			<td><?php echo $data['kelas']; ?></td>
			<td><?php echo $data['jurusan']; ?></td>
		</tr>
		<?php } ?>
	  </tbody>
	</table>

	<?php
}



?>

	<script src="plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>

<script>$("#tblSiswa").dataTable({ "bSort": false });</script>