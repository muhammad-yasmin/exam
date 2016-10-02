<?php
//----------------------------------------------
require "../../../../config/classDB.php";
$conn = new Database();
//----------------------------------------------
$level = $_SESSION['level_nya'];
$id_guru = $_SESSION['id_usernya'];
if($level == 1){
  $query = "SELECT bank.id_bank_soal_ujian, bank.nama_bank_soal_ujian, bank.id_guru, bank.id_tahun_ajaran, bank.semester, bank.id_nama_ujian, bank.tingkat,
                      bank.id_jurusan, bank.jumlah_soal, bank.lama_waktu, bank.id_mapel, bank.password_bank, bank.aktif_bahas,
                      nama.nama_ujian, mapel_tabel.nama_mapel, a.tanggal_aktif
                    FROM
                    bank_soal_ujian_tabel AS bank
                    INNER JOIN nama_ujian_tabel AS nama ON nama.id_nama_ujian = bank.id_nama_ujian
                    INNER JOIN mapel_tabel ON bank.id_mapel = mapel_tabel.id_mapel
                    LEFT JOIN aktivasi_bank_soal AS a ON bank.id_bank_soal_ujian = a.id_bank_soal_ujian
                    ORDER BY
                    bank.id_bank_soal_ujian ASC
                    ";
}else if($level == 2){
  $query = "SELECT bank.id_bank_soal_ujian, bank.nama_bank_soal_ujian, bank.id_guru, bank.id_tahun_ajaran, bank.semester, bank.id_nama_ujian, bank.tingkat,
                      bank.id_jurusan, bank.jumlah_soal, bank.lama_waktu, bank.id_mapel, bank.password_bank, bank.aktif_bahas,
                      nama.nama_ujian, mapel_tabel.nama_mapel, a.tanggal_aktif
                    FROM
                    bank_soal_ujian_tabel AS bank
                    INNER JOIN nama_ujian_tabel AS nama ON nama.id_nama_ujian = bank.id_nama_ujian
                    INNER JOIN mapel_tabel ON bank.id_mapel = mapel_tabel.id_mapel
                    LEFT JOIN aktivasi_bank_soal AS a ON bank.id_bank_soal_ujian = a.id_bank_soal_ujian
                    WHERE
                    bank.id_guru = $id_guru
                    ORDER BY
                    bank.id_bank_soal_ujian ASC
                    ";
}

$proses = $conn->fetch($query);
?>
<table id="example3" class="table table-hover table-bordered table-striped">
  <thead>
      <tr>
        <th width="50px">ID</th>
        <th width="200px">Nama Bank</th>
        <th width="200px">Mata Pelajaran</th>
        <th width="100px">Tanggal</th>
        <th width="100px">Ujian</th>
        <th width="100px">Pembahasan</th>
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
                <td align="center">
                      <?php 
                      if($data['tanggal_aktif'] !== null){
                      $tgl = explode("-", $data['tanggal_aktif']);

                      $hari = $tgl[2];
                      $bulan = $tgl[1];
                      $tahun = $tgl[0];

                      $tgl_jadi = $hari."-".$bulan."-".$tahun; 
                      echo $tgl_jadi;
                      }else{ echo "-"; }
                ?>
                </td>
                <td align="center">
                  <?php 
                  if($data['lama_waktu'] > 0){
                    /*if($tgl_jadi == date('d-m-Y')){
                      ?><a class="btn btn-xs btn-success" disabled="true">Aktif</a><?php
                    }else{
                      ?><a class="btn btn-xs btn-danger" disabled="true">Nonaktif</a><?php
                    }*/
                    ?><a class="btn btn-xs btn-success" disabled="true">Aktif</a><?php
                  }else{
                    ?><a class="btn btn-xs btn-danger" disabled="true">Nonaktif</a><?php
                  }
                  ?>
                  
                </td>
                <td align="center">
                  <?php 
                  if($data['aktif_bahas'] == 'ya'){
                    ?><a class="btn btn-xs btn-success" disabled="true">Aktif</a><?php
                  }else{
                    ?><a class="btn btn-xs btn-danger" disabled="true">Nonaktif</a><?php
                  }
                  ?>
                </td>
                <td align="center">
                  <a onclick="btn_edit(<?php echo $data['id_bank_soal_ujian']; ?>);" style="cursor:pointer;"
                         title="Edit"><i class="fa fa-edit"></i></a>
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

<script>$("#example3").dataTable();</script>