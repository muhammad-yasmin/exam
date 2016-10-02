<?php
$query_buku = "SELECT * FROM buku_tabel";
$proses_query_buku = $conn->fetch($query_buku);
?>
<a style="cursor:pointer;" data-toggle="modal" data-target="#modal_buku">(...)</a>

    <!-- Modal -->
    <div class="modal fade" id="modal_buku" tabindex="-1" role="dialog" aria-labelledby="modalLabel_buku" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="modalLabel_buku">Buku</h4>
                </div>
                <div class="modal-body">
                    <table id="example1" class="table table-hover table-bordered table-striped">
					  <thead>
					      <tr>
					      	<th width="10px">Pilih</th>
					        <th width="800px">Buku</th>
					      </tr>
					  </thead>
					  <tbody>
					    <?php
					      $row_buku = count($proses_query_buku);
					      if($row_buku > 0){
					      		foreach ($proses_query_buku as $key => $data_buku) {
					              
					              ?>
					              <tr>
					              	<td align="center">
					              		<input type="radio" name="input_id_buku" id="input_id_buku" value="<?php echo $data_buku['id_buku']; ?>">
					              	</td>
					                <td id="nama_buku<?php echo $data_buku['id_buku']; ?>"><?php echo $data_buku['judul_buku'];?></td>
					              </tr>
					              <?php
					          }
					      }
					      $new_id_buku = $row_buku + 1;
					    ?>
						<tr>
			              	<td align="center"><input type="radio" name="input_id_buku" id="input_id_buku" value="lain"></td>
			                <td>
			                	<input type="hidden" id="input_new_id_buku" value="<?php echo $new_id_buku; ?>">
			                	Lainnya
			                </td>
			              </tr>
					  </tbody>
					</table>
                </div>
                <div class="modal-footer">
                    <button id="btn_simpan_buku" type="button" class="btn btn-flat btn-primary" data-dismiss="modal">
                        Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>
