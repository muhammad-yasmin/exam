<?php
//----------------------------------------------
require "../../../../config/classDB.php";
$conn = new Database();
//----------------------------------------------
?>
<div role="tabpanel">
  <!-- Nav tabs -->
  <ul class="nav nav-tabs nav-justified" role="tablist">
    <li role="presentation" class="active">
      <a href="#guru" aria-controls="guru" role="tab" data-toggle="tab">Guru</a>
    </li>
    <li role="presentation">
      <a href="#siswa" aria-controls="siswa" role="tab" data-toggle="tab">Siswa</a>
    </li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="guru"><br>
      <p><button type="button" onclick="btn_disconnect('all',2);" class="btn btn-danger btn-xs"><i class="fa fa-power-off"></i> Disconnect Semua Guru</button></p>
      <?php
        $query_guru = "SELECT
                      log_activities.id_log,
                      guru_tabel.id_guru,
                      guru_tabel.nomor,
                      guru_tabel.nama_guru,
                      log_activities.waktu_login,
                      log_activities.`status`
                      FROM
                      log_activities
                      INNER JOIN guru_tabel ON log_activities.nomor_user = guru_tabel.nomor
                      WHERE guru_tabel.nomor <>'admin'
                      ";
        $proses = $conn->fetch($query_guru);
      ?>
        <table id="tabel_guru" class="table table-hover table-bordered table-striped">
          <thead>
              <tr>
                <th width="100px">NIP</th>
                <th width="300px">Nama</th>
                <th width="200px">Waktu Login</th>
                <th width="100px">Opsi</th>
              </tr>
          </thead>
          <tbody>
            <?php
              $jumlah = count($proses);
              if($jumlah > 0){
                  foreach ($proses as $key => $data) {
                      ?>
                      <tr>
                        <td align="center"><?php echo $data['nomor']; ?></td>
                        <td><?php echo $data['nama_guru']; ?></td>
                        <td align="center"><?php echo $data['waktu_login']; ?></td>
                        <td align="center">
                          <a onclick="btn_disconnect('<?php echo $data['id_log']; ?>');" class="btn btn-xs btn-danger" style="cursor:pointer;"
                                title="Disconnect"><i class="fa fa-power-off"></i> Disconnect</a>

                        </td>
                      </tr>
                      <?php
                  }
              }
            ?>
          </tbody>
        </table>
    </div>
    <div role="tabpanel" class="tab-pane" id="siswa"><br>
      <p><button type="button" onclick="btn_disconnect('all',3);" class="btn btn-danger btn-xs"><i class="fa fa-power-off"></i> Disconnect Semua Siswa</button></p>
      <?php
        $query_siswa = "SELECT
                      l.id_log,
                      s.id_siswa,
                      s.nomor,
                      s.nama_siswa,
                      l.waktu_login,
                      l.`status`,
                      s.kelas,
                      j.jurusan
                      FROM
                      log_activities AS l
                      INNER JOIN siswa_tabel AS s ON l.nomor_user = s.nomor
                      INNER JOIN jurusan_tabel AS j ON s.id_jurusan = j.id_jurusan
                      ";
        $proses = $conn->fetch($query_siswa);
      ?>
        <table id="tabel_siswa" class="table table-hover table-bordered table-striped">
          <thead>
              <tr>
                <th width="100px">NIS</th>
                <th width="200px">Nama</th>
                <th width="50px">Kelas</th>
                <th width="100px">Jurusan</th>
                <th width="200px">Waktu Login</th>
                <th width="100px">Opsi</th>
              </tr>
          </thead>
          <tbody>
            <?php
              $jumlah = count($proses);
              if($jumlah > 0){
                  foreach ($proses as $key => $data) {
                      ?>
                      <tr>
                        <td align="center"><?php echo $data['nomor']; ?></td>
                        <td><?php echo $data['nama_siswa']; ?></td>
                        <td align="center"><?php echo $data['kelas']; ?></td>
                        <td align="center"><?php echo $data['jurusan']; ?></td>
                        <td align="center"><?php echo $data['waktu_login']; ?></td>
                        <td align="center">
                          <a onclick="btn_disconnect('<?php echo $data['id_log']; ?>');" class="btn btn-xs btn-danger" style="cursor:pointer;"
                                title="Disconnect"><i class="fa fa-power-off"></i> Disconnect</a>

                        </td>
                      </tr>
                      <?php
                  }
              }
            ?>
          </tbody>
        </table></div>
  </div>
</div>



<script src="plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>

<script>
  $("#tabel_guru").dataTable({ "bSort": false });
  $("#tabel_siswa").dataTable({ "bSort": false });
</script>