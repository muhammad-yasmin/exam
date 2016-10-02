<?php
//----------------------------------------------
require "../../../../config/classDB.php";
$conn = new Database();
//----------------------------------------------
$level  = $_SESSION['level_nya'];
$id_guru = $_SESSION['id_usernya'];
if($level == 1){
  $query = "
      SELECT
      dk.*, s.*, kd.id_kompetensi_dasar, kd.no_kd, kd.nama_kompetensi_dasar,
      b.judul_buku, m.nama_materi, mpl.nama_mapel, guru.nama_guru
      FROM
      draft_kartu_tabel AS dk
      LEFT JOIN soal_tabel AS s ON s.id_soal = dk.id_soal
      LEFT JOIN kompetensi_dasar_tabel AS kd ON dk.id_kompetensi_dasar = kd.id_kompetensi_dasar
      LEFT JOIN buku_tabel AS b ON dk.id_buku = b.id_buku
      LEFT JOIN materi_tabel AS m ON dk.id_materi = m.id_materi
      LEFT JOIN mapel_tabel AS mpl ON m.id_mapel = mpl.id_mapel
      LEFT JOIN guru_tabel AS guru ON dk.id_guru = guru.id_guru
      WHERE dk.status_verifikasi = 'sudah'
      ORDER BY s.id_soal ASC
      ";
}else if($level == 2){
  $select_mapel = $conn->fetch("SELECT id_mapel FROM mapel_guru_tabel WHERE id_guru=$id_guru");
    $i=0;
    foreach ($select_mapel as $key => $value) {
      $mapel[$i] = "dk.id_mapel='".$value['id_mapel']."'";
      $i++;
    }
    $where_mapel = implode(" OR ",$mapel);

    $query = "
      SELECT
      dk.*, s.*, kd.id_kompetensi_dasar,  kd.no_kd, kd.nama_kompetensi_dasar,
      b.judul_buku, m.nama_materi,  mpl.nama_mapel
      FROM
      draft_kartu_tabel AS dk
      LEFT JOIN soal_tabel AS s ON s.id_soal = dk.id_soal
      LEFT JOIN kompetensi_dasar_tabel AS kd ON dk.id_kompetensi_dasar = kd.id_kompetensi_dasar
      LEFT JOIN buku_tabel AS b ON dk.id_buku = b.id_buku
      LEFT JOIN materi_tabel AS m ON dk.id_materi = m.id_materi
      LEFT JOIN mapel_tabel AS mpl ON m.id_mapel = mpl.id_mapel
      WHERE dk.status_verifikasi = 'sudah'
      AND (".$where_mapel.")
      ORDER BY s.id_soal ASC
      ";
}

$proses = $conn->fetch($query);
?>
<table id="example1" class="table table-hover table-bordered table-striped">
  <thead>
      <tr>
        <th width="50px">ID Kartu/Soal</th>
        <th width="100px">Mata Pelajaran</th>
        <?php if($level == 1){ ?><th width="100px">Guru</th><?php } ?>
        <th width="300px">Soal</th>
        <th width="50px">Jawaban</th>
        <th width="100px">Opsi</th>
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
                    <?php //echo $data['id_soal']; ?>
					<?php echo $data['id_kartu_soal'] . "/" . $data['id_soal']; ?>
					
                    <input type="hidden" id="primaryoutkartu<?php echo $index;?>" value="<?php echo $data['id_kartu_soal']; ?>">
                </td>
                <td align="center"><?php echo $data['nama_mapel'];?></td>
                <?php if($level == 1){ ?><td align="center"><?php echo $data['nama_guru']; ?></td><?php } ?>
                <td id="soalout<?php echo $index;?>"><?php echo substr(strip_tags($data['soal']), 0, 80)."...";?></td>
                <td id="jawabanout<?php echo $data['id_kartu_soal']; ?>"><?php echo $data['jawaban'];?></td>
                <td align="center">
                  <!-- Input for edit -->
                    <input type="hidden" id="id_mapel_out<?php echo $data['id_kartu_soal']; ?>" value="<?php echo $data['id_mapel']; ?>">
                    <input type="hidden" id="id_ki_out<?php echo $data['id_kartu_soal']; ?>" value="<?php echo $data['id_kompetensi_inti']; ?>">
                    <input type="hidden" id="id_smt_out<?php echo $data['id_kartu_soal']; ?>" value="<?php echo $data['semester']; ?>">
                    <input type="hidden" id="id_guru_out<?php echo $data['id_kartu_soal']; ?>" value="<?php echo $data['id_guru']; ?>">
                    <input type="hidden" id="id_btes_out<?php echo $data['id_kartu_soal']; ?>" value="<?php echo $data['jml_opsi']; ?>">
                    <input type="hidden" id="id_tapel_out<?php echo $data['id_kartu_soal']; ?>" value="<?php echo $data['id_tahun_ajaran']; ?>">
                    <input type="hidden" id="id_kd_out<?php echo $data['id_kartu_soal']; ?>" value="<?php echo $data['id_kompetensi_dasar']; ?>">
                    <input type="hidden" id="no_kd_out<?php echo $data['id_kartu_soal']; ?>" value="<?php echo $data['no_kd']; ?>">
                    <input type="hidden" id="text_kd_out<?php echo $data['id_kartu_soal']; ?>" value="<?php echo $data['nama_kompetensi_dasar']; ?>">
                    <input type="hidden" id="id_soal_out<?php echo $data['id_kartu_soal']; ?>" value="<?php echo $data['id_soal']; ?>">
                    <input type="hidden" id="id_buku_out<?php echo $data['id_kartu_soal']; ?>" value="<?php echo $data['id_buku']; ?>">
                    <input type="hidden" id="text_buku_out<?php echo $data['id_kartu_soal']; ?>" value="<?php echo $data['judul_buku']; ?>">
                    <input type="hidden" id="id_materi_out<?php echo $data['id_kartu_soal']; ?>" value="<?php echo $data['id_materi']; ?>">
                    <input type="hidden" id="text_materi_out<?php echo $data['id_kartu_soal']; ?>" value="<?php echo $data['nama_materi']; ?>">

                    <textarea style="display:none;" id="text_soal_out<?php echo $data['id_kartu_soal']; ?>" cols="30" rows="10"><?php echo $data['soal']; ?></textarea>
                    <textarea style="display:none;" id="text_soal_pembahasan_out<?php echo $data['id_kartu_soal']; ?>" cols="30" rows="10"><?php echo $data['pembahasan']; ?></textarea>
                  <!-- End -->  

                    <a href="app/pages/preview.php?id=<?php echo $data['id_kartu_soal']; ?>" style="cursor:pointer;"
                        title="Lihat" target="_blank"><i class="fa fa-eye"></i></a>
                    <a onclick="btn_edit('<?php echo $data['id_kartu_soal']; ?>');" style="cursor:pointer;"
                        title="Edit"><i class="fa fa-edit"></i></a>
                    <a onclick="btn_hapus('<?php echo $data['id_kartu_soal']; ?>');" style="cursor:pointer;"
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