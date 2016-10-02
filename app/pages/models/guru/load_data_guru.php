<?php
//----------------------------------------------
require "../../../../config/classDB.php";
$conn = new Database();
//----------------------------------------------

$query = "
SELECT DISTINCT
g.id_guru,
g.nomor,
g.nama_guru,
g.jenis_kelamin,
g.`password`,
g.`level`,
g.`foto`
FROM
guru_tabel AS g
WHERE g.nomor<>'admin' ORDER BY g.id_guru";
$proses = $conn->fetch($query);

$qmapel = "SELECT max(id_mapel) as jml_mapel FROM mapel_tabel";
$pmapel = $conn->fetch($qmapel);
foreach ($pmapel as $key => $rmapel) {
  $mxmapel = $rmapel['jml_mapel'];
}

?>
<input type="hidden" id="maxmapel" value="<?php echo $mxmapel; ?>">
<table id="example1" class="table table-hover table-bordered table-striped">
  <thead>
      <tr>
        <th width="50px">No.</th>
        <th width="200px">NIP</th>
        <th width="300px">Nama</th>
        <th width="100px">Jenis Kelamin</th>
        <th width="50px">Status</th>
        <th width="100px">Opsi</th>
      </tr>
  </thead>
  <tbody>
    <?php
      $jumlah_row = count($proses);
      if($jumlah_row > 0){
          $index = 0;
          $no = 0;
          foreach ($proses as $key => $data) {
              $index++;
              ?>
              <tr>
                <td align="center">
                    <?php echo ++$no; ?>
                    <?php
                      $nomor_guru = $data['nomor'];
                      $query2 = "SELECT
                                  guru_tabel.nomor,
                                  mapel_guru_tabel.id_guru,
                                  mapel_guru_tabel.id_mapel
                                  FROM
                                  mapel_guru_tabel
                                  INNER JOIN guru_tabel ON mapel_guru_tabel.id_guru = guru_tabel.id_guru
                                WHERE nomor='$nomor_guru'";
                      $proses2 = $conn->fetch($query2);
                      foreach ($proses2 as $key => $r) {
                        ?>
                        <input type="hidden" id="mapelout<?php echo $index.$r['id_mapel'];?>" value="<?php echo $r['id_mapel'];?>">
                        <?php
                      }
                    ?>
                    <input type="hidden" id="primaryout<?php echo $index;?>" value="<?php echo $data['id_guru']; ?>">
                    <input type="hidden" id="fotoout<?php echo $index;?>" value="<?php echo $data['foto'];?>">
                </td>
                <td align="center" id="nipout<?php echo $index;?>"><?php echo $data['nomor'];?></td>
                <td id="namaout<?php echo $index;?>"><?php echo $data['nama_guru'];?></td>
                <td align="center" id="jkout<?php echo $index;?>">
                    <?php echo $data['jenis_kelamin'];?>
                </td>
                <td align="center">
                  <?php
                    $nomor_user = $data['nomor'];
                    $cek_status = $conn->fetch("SELECT * FROM log_activities WHERE nomor_user='$nomor_user'");
                    $num_cek = count($cek_status);
                    if($num_cek > 0){
                      foreach ($cek_status as $key => $value) {
                        if($value['status'] == "on"){
                          ?><a class="btn btn-xs btn-success" disabled="true">Online</a><?php
                        }else{
                          ?><a class="btn btn-xs btn-danger" disabled="true">Offline</a><?php
                        }
                      }
                    }else{
                      ?><a class="btn btn-xs btn-danger" disabled="true">Offline</a><?php
                    }
                  ?>
                </td>
                <td align="center">
                    <a onclick="setting_mapel('<?php echo $data['id_guru']; ?>','<?php echo $index;?>');" style="cursor:pointer;"
                        title="Atur Mapel"><i class="fa fa-cog"></i></a>
                    <a onclick="btn_edit('<?php echo $data['id_guru']; ?>','<?php echo $index;?>');" style="cursor:pointer;"
                        title="Edit Data"><i class="fa fa-edit"></i></a>
                    <a onclick="btn_hapus('<?php echo $data['id_guru']; ?>','<?php echo $data['nama_guru'];?>');" style="cursor:pointer;"
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

<script>$("#example1").dataTable({ "bSort": false });</script>