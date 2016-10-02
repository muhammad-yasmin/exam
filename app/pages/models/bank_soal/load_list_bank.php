<?php
//----------------------------------------------
require "../../../../config/classDB.php";
$conn = new Database();
//----------------------------------------------
$level = $_SESSION['level_nya'];
$id_guru = $_SESSION['id_usernya'];
if($level == 1){
  $query = "
      SELECT
      bank.*,
      nama.nama_ujian,
      mapel_tabel.nama_mapel,
      jurusan_tabel.jurusan
      FROM
      bank_soal_ujian_tabel AS bank
      INNER JOIN nama_ujian_tabel AS nama ON nama.id_nama_ujian = bank.id_nama_ujian
      INNER JOIN mapel_tabel ON bank.id_mapel = mapel_tabel.id_mapel
      INNER JOIN jurusan_tabel ON bank.id_jurusan = jurusan_tabel.id_jurusan
      ORDER BY bank.id_bank_soal_ujian";
    }else if($level == 2){
      $query = "
      SELECT
      bank.*,
      nama.nama_ujian,
      mapel_tabel.nama_mapel,
       jurusan_tabel.jurusan
      FROM
      bank_soal_ujian_tabel AS bank
      INNER JOIN nama_ujian_tabel AS nama ON nama.id_nama_ujian = bank.id_nama_ujian
      INNER JOIN mapel_tabel ON bank.id_mapel = mapel_tabel.id_mapel
       INNER JOIN jurusan_tabel ON bank.id_jurusan = jurusan_tabel.id_jurusan
      WHERE bank.id_guru=$id_guru
      ORDER BY bank.id_bank_soal_ujian ASC";
    }

$proses = $conn->fetch($query);
?>
<table id="example2" class="table table-hover table-bordered table-striped">
  <thead>
      <tr>
        <th width="50px">ID</th>
        <th width="300px">Nama</th>
        <th width="200px">Mata Pelajaran</th>
        <th width="100px">Tingkat</th>
        <th width="100px">Jurusan</th>
        <th width="100px">Jumlah Soal</th>
        <th width="100px">Opsi</th>
      </tr>
  </thead>
  <tbody>
    <?php
      $jumlah = count($proses);
      if($jumlah > 0){
          foreach ($proses as $key => $data) {
              ?>
              <tr>
                <td align="center"><?php echo $data['id_bank_soal_ujian']; ?></td>
                <td align="center"><?php echo $data['nama_bank_soal_ujian']; ?></td>
                <td align="center"><?php echo $data['nama_mapel']; ?></td>
                <td align="center"><?php echo $data['tingkat']; ?></td>
                <td align="center"><?php echo $data['jurusan']; ?></td>
                <td align="center"><?php echo $data['jumlah_soal']; ?></td>
                <td align="center">
                  <a onclick="btn_view('<?php echo $data['id_bank_soal_ujian']; ?>');" style="cursor:pointer;"
                         title="Lihat Data"><i class="fa fa-eye"></i></a>
                  <a onclick="btn_hapus('<?php echo $data['id_bank_soal_ujian']; ?>');" style="cursor:pointer;"
                         title="Hapus"><i class="fa fa-trash"></i></a>
                </td>
              </tr>
              <?php
          }
      }
    ?>
  </tbody>
</table>

<script src="plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>

<script>$("#example2").dataTable();</script>