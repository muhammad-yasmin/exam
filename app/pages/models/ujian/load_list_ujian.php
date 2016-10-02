<?php
//----------------------------------------------
require "../../../../config/classDB.php";
$conn = new Database();
//----------------------------------------------
$id_user = $_SESSION['id_usernya'];

$q1 = $conn->fetch("SELECT kelas,id_jurusan FROM siswa_tabel WHERE id_siswa='$id_user'");
$d_kelas = $q1[0]['kelas'];
$d_jrsan = $q1[0]['id_jurusan'];

$query = "
SELECT
b.id_bank_soal_ujian,
b.nama_bank_soal_ujian,
m.nama_mapel,
n.nama_ujian,
g.nama_guru,
b.jumlah_soal,
b.lama_waktu,
a.tanggal_aktif,
a.jam_aktif,
a.`fullscreen`,
a.`block_text`,
a.`focus`
FROM
bank_soal_ujian_tabel AS b
INNER JOIN mapel_tabel AS m ON b.id_mapel = m.id_mapel
INNER JOIN nama_ujian_tabel AS n ON b.id_nama_ujian = n.id_nama_ujian
INNER JOIN guru_tabel AS g ON b.id_guru = g.id_guru
LEFT JOIN aktivasi_bank_soal AS a ON b.id_bank_soal_ujian = a.id_bank_soal_ujian
WHERE
b.lama_waktu > 0 AND
b.tingkat = '$d_kelas' AND
(b.id_jurusan = '$d_jrsan' OR b.id_jurusan = 1) AND
a.tanggal_aktif = CURDATE() AND
a.jam_aktif <= CURTIME() AND
CURTIME() <= DATE_ADD(a.jam_aktif,INTERVAL b.lama_waktu MINUTE)
ORDER BY
b.id_bank_soal_ujian ASC

";
$sql = $conn->fetch($query);
?>
<table id="tabel_ujian" class="table table-bordered" width="100%" style="background-color: #fff;">
  <thead>
  <tr>
    <th width="125px">ID Soal</th>
    <th>Nama Ujian</th>
    <th width="175px">Jenis Ujian</th>
    <th>Penyusun</th>
    <th width="100px">Waktu</th>
    <th width="50px">Kerjakan</th>
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
        <td align="center"><?php echo $ul['nama_bank_soal_ujian']; ?></td>
        <td align="center"><?php echo $ul['nama_ujian']; ?></td>
        <td align="center"><?php echo $ul['nama_guru']; ?></td>
        <td align="center"><?php echo $ul['lama_waktu']; ?> Menit</td>
        <td align="center">
        <input type="hidden" id="td_fullscreen<?php echo $ul['id_bank_soal_ujian']; ?>" value="<?php echo $ul['fullscreen']; ?>" />
        <input type="hidden" id="td_block_text<?php echo $ul['id_bank_soal_ujian']; ?>" value="<?php echo $ul['block_text']; ?>" />
        <input type="hidden" id="td_focus<?php echo $ul['id_bank_soal_ujian']; ?>" value="<?php echo $ul['focus']; ?>" />
          <a onclick="mau_mulai(<?php echo $ul['id_bank_soal_ujian']; ?>);" style="cursor:pointer;"><i class="fa fa-edit"></i></a>
        </td> 
      </tr>
      <?php 
    } 
  } ?>
 
  </tbody>
</table>
