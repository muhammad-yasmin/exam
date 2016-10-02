<?php
//----------------------------------------------
require "../../../../config/classDB.php";
$conn = new Database();
//----------------------------------------------

$query = "SELECT * from kotak_pesan";

$proses = $conn->fetch($query);
?>


</div>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
<table id="example3" class="table table-hover table-bordered table-striped">
  <thead>
      <tr>
        <th width="50px">No.</th>
        <th width="100px">Nama</th>
        <th width="100px">Email</th>
        <th width="400px">Isi</th>
        <th width="100px">Tanggal</th>
          <th width="100px">Opsi</th>
      </tr>
  </thead>
  <tbody>
    <?php
      $jumlah = count($proses);
      if($jumlah > 0){
          $index = 0;
          foreach ($proses as $key => $data) {
              ?>
              <tr>
                <td align="center"><?php echo ++$index; ?></td>
                <td align="center"><?php echo $data['nama']; ?></td>
                <td align="center"><?php echo $data['email']; ?></td>
                <td align="center"><?php echo $data['isi']; ?></td>
                <td align="center"><?php echo $data['tanggal']; ?></td>
                <td align="center">
                  <a onclick="btn_hapus('<?php echo $data['no']; ?>','<?php echo $data['nama'];?>');" style="cursor:pointer;"
                        title="Hapus"><i class="fa fa-trash"></i></a>

                </td>
              </tr>
              <?php
          }
      }
    ?>
  </tbody>
</table>
</div>
</div>

<script src="plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>

<script>$("#example3").dataTable({ "bSort": false });</script>