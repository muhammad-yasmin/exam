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
			";
}else{
	$query = "
			SELECT
      dk.id_draft_kompetensi,
      dk.id_kelompok_mapel,
      dk.id_mapel,
      dk.id_kompetensi_inti,
      dk.id_kompetensi_dasar,
      m.nama_mapel,
      kd.no_kd,
      kd.nama_kompetensi_dasar,
      mg.id_guru
      FROM
      draft_kompetensi_tabel AS dk
      INNER JOIN mapel_tabel AS m ON dk.id_mapel = m.id_mapel
      INNER JOIN kompetensi_dasar_tabel AS kd ON dk.id_kompetensi_dasar = kd.id_kompetensi_dasar
      INNER JOIN mapel_guru_tabel AS mg ON mg.id_mapel = dk.id_mapel
			WHERE mg.id_guru = $id_user
			";
}
$proses = $conn->fetch($query);
?>

<table id="table_kd" class="table table-hover table-bordered table-striped">
  <thead>
      <tr>
      	
        <th width="30px">KD</th>
        <th width="200px">Isi</th>
        <th width="100px">Mata Pelajaran</th>
        <th width="50px">Opsi</th>
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
                    <?php echo $data['id_kompetensi_inti'].".".$data['no_kd'];?>
                </td>
                <td id="text_kd_out<?php echo $data['id_draft_kompetensi'];?>"><?php echo $data['nama_kompetensi_dasar'];?></td>
                <td align="center"><?php echo $data['nama_mapel'];?></td>
                <td align="center">

                	<input type="hidden" id="primaryout<?php echo $data['id_draft_kompetensi'];?>" value="<?php echo $data['id_draft_kompetensi'];?>">
                	<input type="hidden" id="id_kd_out<?php echo $data['id_draft_kompetensi'];?>" value="<?php echo $data['id_kompetensi_dasar'];?>">
                	<input type="hidden" id="no_kd_out<?php echo $data['id_draft_kompetensi'];?>" value="<?php echo $data['no_kd'];?>">
                    <input type="hidden" id="id_mapel_out<?php echo $data['id_draft_kompetensi'];?>" value="<?php echo $data['id_mapel'];?>">
					
                    <a onclick="btn_edit('<?php echo $data['id_draft_kompetensi'];?>');" style="cursor:pointer;color:#333;"
                        title="Edit Data"><i class="fa fa-edit"></i></a> 
                    <a onclick="btn_hapuskd('<?php echo $data['id_draft_kompetensi'];?>');" style="cursor:pointer;color:#333;"
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

<script>$("#table_kd").dataTable({ "bSort": false });</script>