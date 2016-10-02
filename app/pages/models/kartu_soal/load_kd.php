<?php
//----------------------------------------------
require "../../../../config/classDB.php";
$conn = new Database();
//----------------------------------------------
$mapelnya = $_POST['mapel'];
$query_kd = "
            SELECT
            dk.id_kompetensi_inti,
            kd.id_kompetensi_dasar,
            kd.no_kd,
            kd.nama_kompetensi_dasar
            FROM
            draft_kompetensi_tabel AS dk
            INNER JOIN kompetensi_dasar_tabel AS kd ON dk.id_kompetensi_dasar = kd.id_kompetensi_dasar
            WHERE
            dk.id_kompetensi_inti = 3 AND dk.id_mapel = $mapelnya
          ";
$proses_query_kd = $conn->fetch($query_kd);
?>
<a style="cursor:pointer;" data-toggle="modal" data-target="#modal_kd">(...)</a>

<!-- Modal -->
    <div class="modal fade" id="modal_kd" tabindex="-1" role="dialog" aria-labelledby="modalLabel_kd" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="modalLabel_kd">Kompetensi Dasar</h4>
                </div>
                <div class="modal-body">
                    <table id="example1" class="table table-hover table-bordered table-striped">
            <thead>
                <tr>
                  <th width="10px">Pilih</th>
                  <th width="10px">No.</th>
                  <th width="800px">Kompetensi Dasar</th>
                </tr>
            </thead>
            <tbody>
              <?php
                $row_kd = count($proses_query_kd);
                if($row_kd > 0){
                    foreach ($proses_query_kd as $key => $data_kd) {

                        ?>
                        <tr>
                          <td align="center"><input type="radio" name="input_id_kd[]" id="input_id_kd" value="<?php echo $data_kd['id_kompetensi_dasar']; ?>"></td>
                          <td id="id_no_kd<?php echo $data_kd['id_kompetensi_dasar']; ?>" align="center">
                              <?php echo $data_kd['no_kd']; ?>
                          </td>
                          <td id="nama_kd<?php echo $data_kd['id_kompetensi_dasar']; ?>">
                            <?php echo $data_kd['nama_kompetensi_dasar'];?>
                          </td>
                        </tr>
                        <?php
                    }
                }
              ?>

            </tbody>
          </table>
                </div>
                <div class="modal-footer">
                    <button id="btn_simpan_kd" type="button" class="btn btn-flat btn-primary" data-dismiss="modal">
                        Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>