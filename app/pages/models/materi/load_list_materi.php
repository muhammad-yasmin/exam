<?php
//----------------------------------------------
require "../../../../config/classDB.php";
$conn = new Database();
//----------------------------------------------
$id_kd = $_POST['id_kd'];

$query = "SELECT * FROM materi_tabel WHERE id_kompetensi_dasar=$id_kd";
$proses = $conn->fetch($query);
?>
<table id="table_materi2" class="table table-hover table-bordered table-striped">
  <thead>
      <tr>
        <th width="30px">No.</th>
        <th width="200px">Materi Pokok</th>
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
                    <?php echo $data['no_materi'];?>
                </td>
                <td id="nama_materi_out<?php echo $data['id_materi'];?>">
                  <?php echo $data['nama_materi']; ?>
                </td>
                <td align="center">
                    <a onclick="btn_edit('<?php echo $data['id_materi'];?>');" style="cursor:pointer;color:#333;"
                        title="Edit Data"><i class="fa fa-edit"></i></a> 
                    <a onclick="btn_hapus('<?php echo $data['id_materi'];?>');" style="cursor:pointer;color:#333;"
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

<script>$("#table_materi2").dataTable({ "bSort": false });</script>