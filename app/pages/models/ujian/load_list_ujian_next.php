<?php
//----------------------------------------------
require "../../../../config/classDB.php";
$conn = new Database();
//----------------------------------------------
$id_user = $_SESSION['id_usernya'];

$q1 = $conn->fetch("SELECT id_jurusan FROM siswa_tabel WHERE id_siswa='$id_user'");

foreach ($q1 as $key => $rs) {
 $d_jrsan = $rs['id_jurusan'];
}

$query = "
SELECT
b.id_bank_soal_ujian,
m.nama_mapel,
n.nama_ujian,
g.nama_guru,
b.jumlah_soal,
b.lama_waktu,
a.tanggal_aktif,
a.jam_aktif,
a.`status`
FROM
bank_soal_ujian_tabel AS b
INNER JOIN mapel_tabel AS m ON b.id_mapel = m.id_mapel
INNER JOIN nama_ujian_tabel AS n ON b.id_nama_ujian = n.id_nama_ujian
INNER JOIN guru_tabel AS g ON b.id_guru = g.id_guru
LEFT JOIN aktivasi_bank_soal AS a ON b.id_bank_soal_ujian = a.id_bank_soal_ujian
WHERE
b.lama_waktu > 0 AND
b.id_jurusan = '$d_jrsan' AND
a.tanggal_aktif = CURDATE() AND
a.jam_aktif > CURTIME()
ORDER BY
a.jam_aktif ASC
";
$sql = $conn->fetch($query);
?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>ID</th>
			<th>Nama Mapel</th>
		    <th>Nama Ujian</th>
		    <th>Nama Guru</th>
		    <th>Jumlah Soal</th>
		    <th>Jam Ujian</th>
		</tr>
	</thead>
	<tbody>
		<?php
  $no=1;
  foreach ($sql as $key => $ul) {

    $id_bnk = $ul['id_bank_soal_ujian'];
    $cek_que = $conn->fetch("SELECT * FROM bank_hasil_ujian_tabel WHERE id_siswa='$id_user' AND id_bank_soal_ujian='$id_bnk'");
    $num_cek = count($cek_que);
    if($num_cek > 0){
      continue;
    }else{
      ?>
      <tr>
        <td align="center"><?php echo $ul['id_bank_soal_ujian']; ?></td>
        <td align="center"><?php echo $ul['nama_mapel']; ?></td>
        <td align="center"><?php echo $ul['nama_ujian']; ?></td>
        <td align="center"><?php echo $ul['nama_guru']; ?></td>
        <td align="center"><?php echo $ul['jumlah_soal']; ?></td>
        <td align="center"><?php echo $ul['jam_aktif']; ?></td>
        
      </tr>
      <?php 
    } 
  } ?>
	</tbody>
</table>