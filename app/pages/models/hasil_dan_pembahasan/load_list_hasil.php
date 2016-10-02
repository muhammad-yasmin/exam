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
bh.id_bank_hasil_ujian,
bh.id_bank_soal_ujian,
m.nama_mapel,
nu.nama_ujian,
bh.tgl_ujian,
bh.skor_nilai,
bh.keterangan,
bh.id_siswa,
bs.nama_bank_soal_ujian,
bs.aktif_bahas
FROM
bank_hasil_ujian_tabel AS bh
INNER JOIN bank_soal_ujian_tabel AS bs ON bh.id_bank_soal_ujian = bs.id_bank_soal_ujian
INNER JOIN nama_ujian_tabel AS nu ON bs.id_nama_ujian = nu.id_nama_ujian
INNER JOIN mapel_tabel AS m ON bs.id_mapel = m.id_mapel
WHERE bh.id_siswa='$id_user' AND bs.aktif_bahas='ya'

";
$sql = $conn->fetch($query);
?>
<table id="tabel_hasil" class="table table-striped table-bordered" width="100%" style="background-color: #fff;">
  <thead>
  <tr>
    <th width="150px">ID Soal</th>
    <th>Nama Ujian</th>
    <th>Tanggal Ujian</th>
    <th>Nilai</th>
    <th>Keterangan</th>
    <th>Opsi</th>
  </tr>
  </thead>
  <tbody> 
  <?php
  $no=1;
  foreach ($sql as $key => $ul) {

      ?>
      <tr>
        <td align="center"><?php echo $ul['id_bank_hasil_ujian']; ?></td>
        <td align="center"><?php echo $ul['nama_bank_soal_ujian']; ?></td>
        <td align="center"><?php echo $ul['tgl_ujian']; ?></td>
        <td align="center"><?php echo $ul['skor_nilai']; ?></td>
        <td align="center"><?php echo $ul['keterangan']; ?></td>
        <td align="center"><a class="btn btn-xs btn-primary" onclick="mau_mulai(<?php echo $ul['id_bank_soal_ujian']; ?>);" style="cursor:pointer;">Pembahasan</a></td> 
      </tr>
      <?php 
  } ?>
 
  </tbody>
</table>
<script src="plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>

<script>$("#tabel_hasil").dataTable({ "bSort": false });</script>