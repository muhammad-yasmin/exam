<?php
//----------------------------------------------
require "../../../../config/classDB.php";
$conn = new Database();
//----------------------------------------------

$query = "
SELECT
km.nama_kelompok_mapel,
m.*
FROM
mapel_tabel AS m
INNER JOIN kelompok_mapel_tabel AS km ON km.id_mapel = m.id_mapel
ORDER BY m.kode_mapel ASC
";
$proses = $conn->fetch($query);
?>

<table id="example1" class="table table-hover table-bordered table-striped">
  <thead>
      <tr>
        <th width="50px">ID</th>
        <th width="100px">Kelompok</th>
        <th width="300px">Kode</th>
        <th width="400px">Nama</th>
        <th width="100px">Kelas</th>
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
                    <?php echo $data['id_mapel']; ?>
                    <input type="hidden" id="primaryout<?php echo $index;?>" value="<?php echo $data['id_mapel']; ?>">
                </td>
                <td align="center" id="kelompokout<?php echo $index;?>"><?php echo $data['nama_kelompok_mapel'];?></td>
                <td align="center" id="kodeout<?php echo $index;?>"><?php echo $data['kode_mapel'];?></td>
                <td align="center" id="namaout<?php echo $index;?>"><?php echo $data['nama_mapel'];?></td>
                <td align="center" id="kelasout<?php echo $index;?>"><?php echo $data['tingkat'];?></td>
                <td align="center">

                  <!-- Buat Edit Jurusan Mapel -->
                  <?php
                  $mpl = $data['id_mapel'];
                  $q_jurusan = $conn->fetch("SELECT * FROM mapel_jurusan_tabel WHERE id_mapel=$mpl");
                  $n_jurusan = count($q_jurusan);
                  if($n_jurusan > 1){
                    ?><input type="hidden" id="jrsanout<?php echo $index;?>" value="all"><?php
                  }else{
                    foreach ($q_jurusan as $key => $r_jurusan) {
                      ?><input type="hidden" id="jrsanout<?php echo $index;?>" value="<?php echo $r_jurusan['id_jurusan']; ?>"><?php
                    }
                  }
                  ?>
                  <!-- End -->

                    <a onclick="btn_edit('<?php echo $data['id_mapel']; ?>','<?php echo $index;?>');" style="cursor:pointer;"
                        title="Edit Data"><i class="fa fa-edit"></i></a>
                    <a onclick="btn_hapus('<?php echo $data['id_mapel']; ?>','<?php echo $data['nama_mapel'];?>');" style="cursor:pointer;" title="Hapus"><i class="fa fa-trash"></i></a>
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