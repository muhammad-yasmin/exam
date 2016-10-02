<?php
//----------------------------------------------
require "../../../../config/classDB.php";
$conn = new Database();
//----------------------------------------------

$id_kdnya = $_POST['id_kd'];
$mapelnya = $_POST['mapel'];
$query_materi = " SELECT * FROM materi_tabel WHERE id_mapel=$mapelnya AND id_kompetensi_dasar=$id_kdnya";
$proses_query_materi = $conn->fetch($query_materi);

?>
<table id="example1" class="table table-hover table-bordered table-striped">
  <thead>
      <tr>
        <th width="10px">Pilih</th>
        <th width="10px">No.</th>
        <th width="800px">Materi</th>
      </tr>
  </thead>
  <tbody>
    <?php
                $row_materi = count($proses_query_materi);
                if($row_materi > 0){
                    foreach ($proses_query_materi as $key => $data_materi) {

                        ?>
                        <tr>
                          <td align="center"><input type="radio" name="input_id_materi[]" id="input_id_materi" value="<?php echo $data_materi['id_materi']; ?>"></td>
                          <td align="center">
                              <?php echo $data_materi['no_materi']; ?>
                          </td>
                          <td id="nama_materi<?php echo $data_materi['id_materi']; ?>">
                            <?php echo $data_materi['nama_materi'];?>
                          </td>
                        </tr>
                        <?php
                    }
                }
              ?>
  </tbody>
</table>

