
<?php
//----------------------------------------------
require "../../../../config/classDB.php";
$conn = new Database();
//----------------------------------------------

$proses = $conn->fetch("SELECT * FROM nama_ujian_tabel ORDER BY id_nama_ujian ASC");

?>

<table id="example1" class="table table-hover table-bordered table-striped">
  <thead>
      <tr>
        <th width="10px">ID</th>
        <th width="400px">Nama</th>
        <th width="10px">Opsi</th>
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
                    <?php echo $data['id_nama_ujian']; ?>
                    <input type="hidden" id="primaryout<?php echo $index;?>" value="<?php echo $data['id_nama_ujian']; ?>">
                </td>
                <td id="namaout<?php echo $index;?>"><?php echo $data['nama_ujian'];?></td>
                    <td align="center">
                    <a onclick="btn_edit('<?php echo $data['id_nama_ujian']; ?>','<?php echo $index;?>');" style="cursor:pointer;"
                        title="Edit Data"><i class="fa fa-edit"></i></a> 
                    <a onclick="btn_hapus('<?php echo $data['id_nama_ujian']; ?>');" style="cursor:pointer;"
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