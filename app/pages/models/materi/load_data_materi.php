<?php
//----------------------------------------------
require "../../../../config/classDB.php";
$conn = new Database();
//----------------------------------------------
$id_user = $_SESSION['id_usernya'];
$level = $_SESSION['level_nya'];

if($level == 1){
  $query = "
      SELECT
      dk.id_draft_kompetensi,
      dk.id_kelompok_mapel,
      dk.id_mapel,
      dk.id_kompetensi_inti,
      dk.id_kompetensi_dasar,
      m.nama_mapel,
      kompetensi_dasar_tabel.no_kd,
      kompetensi_dasar_tabel.nama_kompetensi_dasar
      FROM
      draft_kompetensi_tabel AS dk
      INNER JOIN mapel_tabel AS m ON dk.id_mapel = m.id_mapel
      INNER JOIN kompetensi_dasar_tabel ON dk.id_kompetensi_dasar = kompetensi_dasar_tabel.id_kompetensi_dasar
      WHERE dk.id_kompetensi_inti = 3
      ";
}else{
  $query = "
      SELECT
      mg.id_guru,
      dk.id_draft_kompetensi,
      dk.id_mapel,
      dk.id_kompetensi_inti,
      dk.id_kompetensi_dasar,
      kd.no_kd,
      kd.nama_kompetensi_dasar,
      m.nama_mapel
      FROM
      mapel_guru_tabel AS mg
      INNER JOIN draft_kompetensi_tabel AS dk ON mg.id_mapel = dk.id_mapel
      INNER JOIN kompetensi_dasar_tabel AS kd ON dk.id_kompetensi_dasar = kd.id_kompetensi_dasar
      INNER JOIN mapel_tabel AS m ON mg.id_mapel = m.id_mapel
      WHERE mg.id_guru = $id_user AND dk.id_kompetensi_inti = 3
      ";
}
$proses = $conn->fetch($query);
?>

<table id="table_materi" class="table table-hover table-bordered table-striped">
  <thead>
      <tr>
        <th width="100px">Mata Pelajaran</th>
        <th width="30px">KD</th>
        <th width="200px">Materi Pokok</th>
        <th width="50px">Pilih</th>
      </tr>
  </thead>
  <tbody>
    <?php
      $jumlah_row = count($proses);
      if($jumlah_row > 0){
          foreach ($proses as $key => $data) {
              ?>
              <tr>
              <td align="center">
                    <?php echo $data['nama_mapel'];?>
              </td>
                
                <td align="center">
                    <?php echo $data['id_kompetensi_inti'].".".$data['no_kd'];?>
                </td>
                <td id="text_kd_out<?php echo $data['id_draft_kompetensi'];?>">
                  <?php
                    $id_mapel = $data['id_mapel'];
                    $id_kd = $data['id_kompetensi_dasar'];
                    $que_materi = $conn->fetch("SELECT * FROM materi_tabel WHERE id_mapel=$id_mapel AND id_kompetensi_dasar=$id_kd");
                    $no = 1;
                    $nums = count($que_materi);
                    foreach ($que_materi as $key => $r) {
                      echo $r['nama_materi'];
                      if($no == $nums){
                        echo ".";
                      }else{
                        echo ", ";
                      }
                      $no++;
                    }
                  ?>
                </td>
                <td align="center">
                    <input type="hidden" id="id_mapel_out<?php echo $data['id_kompetensi_dasar'];?>" value="<?php echo $data['id_mapel']; ?>">
                    <input type="hidden" id="nama_kd_out<?php echo $data['id_kompetensi_dasar'];?>" value="<?php echo $data['nama_kompetensi_dasar']; ?>">
                    <a onclick="btn_select('<?php echo $data['no_kd']; ?>','<?php echo $data['id_kompetensi_dasar'];?>');" style="cursor:pointer;"
                        title="Pilih"><i class="fa fa-check"></i></a> 
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

<script>$("#table_materi").dataTable({ "bSort": false });</script>