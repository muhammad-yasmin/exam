<?php
$query_ki = "SELECT * FROM kompetensi_inti_tabel WHERE id_kompetensi_inti>2";
$proses_query_ki = $conn->fetch($query_ki);
?>
<a class="btn btn-default" data-toggle="modal" data-target="#modal_ki" style="cursor:pointer;">(...)</a>

    <!-- Modal -->
    <div class="modal fade" id="modal_ki" tabindex="-1" role="dialog" aria-labelledby="modalLabel_ki" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="modalLabel_ki">Kompetensi Inti</h4>
                </div>
                <div class="modal-body">
                    <table id="example1" class="table table-hover table-bordered table-striped">
					  <thead>
					      <tr>
					      	<th width="10px">Pilih</th>
					        <th width="10px">No.</th>
					        <th width="800px">Kompetensi Inti</th>
					      </tr>
					  </thead>
					  <tbody>
					    <?php
					      $row_ki = count($proses_query_ki);
					      if($row_ki > 0){
					      	foreach ($proses_query_ki as $key => $data_ki) {

					              ?>
					              <tr>
					              	<td align="center"><input type="radio" name="input_id_ki[]" id="input_id_ki" value="<?php echo $data_ki['id_kompetensi_inti']; ?>"></td>
					                <td align="center">
					                    <?php echo $data_ki['id_kompetensi_inti']; ?>
					                </td>
					                <td><?php echo $data_ki['nama_kompetensi_inti'];?></td>
					              </tr>
					              <?php
					          }
					      }
					    ?>

					  </tbody>
					</table>
                </div>
                <div class="modal-footer">
                    <button id="btn_simpan_ki" type="button" class="btn btn-flat btn-primary" data-dismiss="modal">
                        Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>