<?php
//----------------------------------------------
require "../../../../config/classDB.php";
$conn = new Database();
//----------------------------------------------

$tapel=$_POST['tapel'];
$semester=$_POST['semester'];
$ujian=$_POST['ujian'];
$jurusan=$_POST['jurusan'];
$tingkat=$_POST['tingkat'];

$query=$conn->fetch("SELECT
jurusan_tabel.jurusan,
siswa_tabel.id_siswa,
siswa_tabel.nomor,
siswa_tabel.nama_siswa,
siswa_tabel.jenis_kelamin,
siswa_tabel.kelas,
siswa_tabel.`password`,
siswa_tabel.`level`,
siswa_tabel.foto,
siswa_tabel.id_jurusan
FROM
siswa_tabel
INNER JOIN jurusan_tabel ON siswa_tabel.id_jurusan = jurusan_tabel.id_jurusan WHERE siswa_tabel.kelas='$tingkat' AND 
siswa_tabel.id_jurusan='$jurusan' ");
?>
<table id="example1" class="table table-hover table-bordered table-striped">
  <thead>
      <tr>
        <th width="200px">NIS</th>
        <th width="400px">Nama</th>
        <th width="50px">Opsi</th>
      </tr>
  </thead>
  <tbody>
    <?php
      $jumlah_row = count($query);
      if($jumlah_row > 0){
          $index = 0;
          $no = 0;
          foreach ($query as $key => $data) {
              $index++;
              ?>
              <tr>
                <td align="center" id="nisout<?php echo $index;?>"><?php echo $data['nomor'];?></td>
                <td id="namaout<?php echo $index;?>"><?php echo $data['nama_siswa'];?></td>
     			<td align="center">
     			<a onclick="load_nilai_siswa(<?php echo $data['id_siswa'];?>);" style="cursor:pointer;">Lihat</a>
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