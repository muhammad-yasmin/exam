<?php
//----------------------------------------------
require "../../../../config/classDB.php";
$conn = new Database();
//----------------------------------------------

$query = "
SELECT
siswa_tabel.*,
jurusan_tabel.jurusan
FROM
siswa_tabel
INNER JOIN jurusan_tabel ON siswa_tabel.id_jurusan = jurusan_tabel.id_jurusan
";
$proses = $conn->fetch($query);
?>

<table id="example1" class="table table-hover table-bordered table-striped">
  <thead>
      <tr>
        <th width="150px">NIS</th>
        <th width="400px">Nama</th>
        <th width="100px">Jenis Kelamin</th>
        <th width="50px">Kelas</th>
        <th width="100px">Jurusan</th>
        <th width="50px">Status</th>
        <th width="50px">Opsi</th>
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
                <td align="center" id="nisout<?php echo $index;?>"><?php echo $data['nomor'];?></td>
                <td id="namaout<?php echo $index;?>"><?php echo $data['nama_siswa'];?></td>
                <td id="jkout<?php echo $index;?>"><?php echo $data['jenis_kelamin'];?></td>
                <td align="center" id="kelasout<?php echo $index;?>"><?php echo $data['kelas'];?></td>
                <td align="center">
                    <input type="hidden" id="jurusanout<?php echo $index;?>" name="jurusanout<?php echo $index;?>" value="<?php echo $data['id_jurusan'];?>">
                    <?php echo $data['jurusan'];?>
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
                    <input type="hidden" id="primaryout<?php echo $index;?>" value="<?php echo $data['id_siswa']; ?>">
                    <input type="hidden" id="fotoout<?php echo $index;?>" value="<?php echo $data['foto'];?>">
                    <a onclick="btn_edit('<?php echo $data['id_siswa']; ?>','<?php echo $index;?>');" style="cursor:pointer;"
                        title="Edit Data"><i class="fa fa-edit"></i></a> 
                    <a onclick="btn_hapus('<?php echo $data['id_siswa']; ?>','<?php echo $data['nama_siswa'];?>');" style="cursor:pointer;"
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