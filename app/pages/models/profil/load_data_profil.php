<?php
//----------------------------------------------
require "../../../../config/classDB.php";
$conn = new Database();
//----------------------------------------------

$id_user = $_SESSION['id_usernya'];
$level = $_SESSION['level_nya'];

if($level == 1){
	$query = "SELECT * FROM guru_tabel WHERE id_guru = '$id_user'";
	$proses = $conn->fetch($query);
	foreach ($proses as $key => $data) {
		$Nama = $data['nama_guru'];
		$User = $data['nomor'];
		$Pass = $data['password'];
		?>
		<legend>Data Admin</legend>
		<ul class="list-group">
			<li class="list-group-item">Nama : <span class="pull-right"><?php echo $Nama; ?></span></li>
			<li class="list-group-item">Username : <span class="pull-right"><?php echo $User; ?></span></li>
			<li class="list-group-item">Password : <span class="pull-right"><?php echo $Pass; ?> <a onclick="show_divpass();" style="cursor: pointer;" class="btn btn-xs btn-info" title="Edit Password"><i class="fa fa-pencil"></i> Ganti</a></span></li>
		</ul>
		<?php
	}
}else if($level == 2){
	$query = "SELECT * FROM guru_tabel WHERE id_guru = '$id_user'";
	$proses = $conn->fetch($query);
	foreach ($proses as $key => $data) {
		$Nama = $data['nama_guru'];
		$JK	  = $data['jenis_kelamin'];
		$NIP = $data['nomor'];
		$Pass = $data['password'];
		?>
		<legend>Data Guru</legend>
		<ul class="list-group">
			<li class="list-group-item">NIP : <span class="pull-right"><?php echo $NIP; ?></span></li>
			<li class="list-group-item">Nama : <span class="pull-right"><?php echo $Nama; ?></span></li>
			<li class="list-group-item">Jenis Kelamin : <span class="pull-right"><?php echo $JK; ?></span></li>
			<li class="list-group-item">Password : <span class="pull-right"><?php echo $Pass; ?> <a onclick="show_divpass();" style="cursor: pointer;" class="btn btn-xs btn-info" title="Edit Password"><i class="fa fa-pencil"></i> Ganti</a></span></li>
		</ul>
		<?php
	}
}else{
	$query = "SELECT * FROM siswa_tabel WHERE id_siswa = '$id_user'";
	$query2 = "SELECT
          draft_kelas_tabel.id_draft_kelas,
          draft_kelas_tabel.id_kelas,
          draft_kelas_tabel.id_guru,
          draft_kelas_tabel.id_siswa,
          kelas_tabel.tingkat,
          kelas_tabel.kelas
          FROM
          draft_kelas_tabel
          INNER JOIN kelas_tabel ON draft_kelas_tabel.id_kelas = kelas_tabel.id_kelas
          WHERE
          draft_kelas_tabel.id_siswa = '$id_user'";
	$proses = $conn->fetch($query);
	$proses2 = $conn->fetch($query2);
	foreach ($proses as $key => $data) {
		$NIS = $data['nomor'];
		$Nama = $data['nama_siswa'];
		$JK = $data['jenis_kelamin'];
		$Pass = $data['password'];
	}
	if(count($proses2) > 0){
		$Kelas = $proses2[0]['tingkat']." / ".$proses2[0]['kelas'];
	}else{
		$Kelas = $proses[0]['kelas']." / -";
	}
	
	?>
		<legend>Data Siswa</legend>
		<ul class="list-group">
			<li class="list-group-item">NIS : <span class="pull-right"><?php echo $NIS; ?></span></li>
			<li class="list-group-item">Nama : <span class="pull-right"><?php echo $Nama; ?></span></li>
			<li class="list-group-item">Jenis Kelamin : <span class="pull-right"><?php echo $JK; ?></span></li>
			<li class="list-group-item">Tingkat/Kelas : <span class="pull-right"><?php echo $Kelas; ?></span></li>
			<li class="list-group-item">Password : <span class="pull-right"><?php echo $Pass; ?> <a onclick="show_divpass();" style="cursor: pointer;" class="btn btn-xs btn-info" title="Edit Password"><i class="fa fa-pencil"></i> Ganti</a></span></li>
		</ul>
		<?php
}
?>

