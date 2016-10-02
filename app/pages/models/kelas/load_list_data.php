
<?php
//----------------------------------------------
require "../../../../config/classDB.php";
$conn = new Database();
//----------------------------------------------

$proses = $conn->fetch("
          SELECT
          kelas_tabel.id_kelas,
          kelas_tabel.tingkat,
          kelas_tabel.kelas,
          kelas_tabel.id_tahun_ajaran,
          kelas_tabel.jumlah_siswa,
          tahun_ajaran_tabel.tahun_ajaran
          FROM
          kelas_tabel
          INNER JOIN tahun_ajaran_tabel ON kelas_tabel.id_tahun_ajaran = tahun_ajaran_tabel.id_tahun_ajaran
          ");
?>

<table id="example1" class="table table-hover table-bordered table-striped">
  <thead>
      <tr>
        <th width="10px">No.</th>
        <th width="100px">Tingkat</th>
        <th width="100px">Kelas</th>
        <th width="100px">Jumlah Siswa</th>
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
                    <?php echo ++$no; ?>
                    <input type="hidden" id="primaryout<?php echo $index;?>" value="<?php echo $data['id_kelas']; ?>">
                </td>
                <td><?php echo $data['tingkat'];?></td>
                <td><?php echo $data['kelas'];?></td>
                <td><?php echo $data['jumlah_siswa'];?></td>
                <td align="center">
                    <a onclick="btn_lihat('<?php echo $data['id_kelas']; ?>');" style="cursor:pointer;"
                        title="Lihat Data"><i class="fa fa-eye"></i></a>
                    <a onclick="btn_hapus('<?php echo $data['id_kelas']; ?>','<?php echo $data['kelas']; ?>');" style="cursor:pointer;"
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