<?php
//----------------------------------------------
require "../../config/classDB.php";
$conn = new Database();
//----------------------------------------------

$text_cari = $_POST['text_cari'];
$kelas = $_POST['kelas'];
$jurusan = $_POST['jurusan'];

if($kelas == "" || $jurusan == ""){
	$query_siswa = "SELECT
              l.id_log,
              s.id_siswa,
              s.nomor,
              s.nama_siswa,
              l.waktu_login,
              l.`status`,
              s.kelas,
              j.jurusan
              FROM
              log_activities AS l
              INNER JOIN siswa_tabel AS s ON l.nomor_user = s.nomor
              INNER JOIN jurusan_tabel AS j ON s.id_jurusan = j.id_jurusan
              WHERE s.nomor LIKE '%$text_cari%' OR s.nama_siswa LIKE '%$text_cari%'
              ";
}else{
	$query_siswa = "SELECT
              l.id_log,
              s.id_siswa,
              s.nomor,
              s.nama_siswa,
              l.waktu_login,
              l.`status`,
              s.kelas,
              j.jurusan
              FROM
              log_activities AS l
              INNER JOIN siswa_tabel AS s ON l.nomor_user = s.nomor
              INNER JOIN jurusan_tabel AS j ON s.id_jurusan = j.id_jurusan
              WHERE s.kelas = '$kelas' AND s.id_jurusan = '$jurusan' AND (s.nomor LIKE '%$text_cari%' OR s.nama_siswa LIKE '%$text_cari%')
              ";
}


$proses = $conn->fetch($query_siswa);
$jumlah = count($proses);
  if($jumlah > 0){
      foreach ($proses as $key => $data) {
          ?>
          <div class="panel panel-default">
	    		<div class="panel-body">
	    			<b><?php echo $data['nomor']; ?></b><br>
	    			<b><?php echo $data['nama_siswa']; ?></b><br>
	    			<b><?php echo $data['kelas']." / ".$data['jurusan']; ?></b><br><br>
	    			<a onclick="btn_disconnect('<?php echo $data['id_log']; ?>');" class="btn btn-danger" style="cursor:pointer; width:100%;"
                    title="Disconnect"><i class="fa fa-power-off"></i> Disconnect</a>
	    		</div>
	    	</div>
          <?php
      }
  }else{
  	?>
  	<div class="panel panel-default">
  		<div class="panel-body" style="text-align:center;">
  			<b>Tidak ada siswa yang aktif !</b>
  		</div>
  	</div>
  	<?php
  }
?>