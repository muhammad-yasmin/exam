<?php
//----------------------------------------------
require "../../../../config/classDB.php";
$conn = new Database();
//----------------------------------------------

$id_jurusan = $_POST['jurusan'];
if($id_jurusan == 0){
    $query = "
        SELECT
        m.id_mapel,
        m.kode_mapel,
        m.nama_mapel,
        m.tingkat,
        m.satuan_pendidikan
        FROM mapel_tabel AS m 
        ";
}else{
    $query = "
        SELECT
        mj.id_jurusan,
        m.id_mapel,
        m.kode_mapel,
        m.nama_mapel,
        m.tingkat,
        m.satuan_pendidikan
        FROM
        mapel_jurusan_tabel AS mj
        INNER JOIN mapel_tabel AS m ON mj.id_mapel = m.id_mapel
        WHERE mj.id_jurusan = '$id_jurusan'
        ";
}

$proses = $conn->fetch($query);
?>
<label id="label_id_mapel">Mata Pelajaran</label><br>      
<table id="examplex" class="table table-hover table-bordered table-striped">
  <thead>
      <tr>
        <th width="50px">Pilih</th>
        <th width="600px">Mata Pelajaran</th>
        <th>Kelas</th>
      </tr>
  </thead>
  <tbody>
    <?php
        $nums = count($proses);
        if($nums > 0){
            foreach ($proses as $key => $data) {
                ?>
                <tr>
                    <td align="center">
                        <input type="checkbox" class="cekbox" id="input_id_mapel<?php echo $data['id_mapel']; ?>" name="input_id_mapel[]" value="<?php echo $data['id_mapel']; ?>">
                    </td>
                    <td>
                        <?php echo $data['nama_mapel']; ?>
                    </td>
                    <td align="center">
                        <?php echo $data['tingkat']; ?>
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

<script>$("#examplex").dataTable({ "bSort": false });</script>

