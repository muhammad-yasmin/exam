<?php
$id_user = $_SESSION['id_usernya'];
$query_siswa = "
SELECT
siswa_tabel.*,
jurusan_tabel.jurusan
FROM
siswa_tabel
INNER JOIN jurusan_tabel ON siswa_tabel.id_jurusan = jurusan_tabel.id_jurusan
WHERE id_siswa = '$id_user'";
$proses_siswa = mysql_query($query_siswa);
$result_siswa = mysql_fetch_assoc($proses_siswa);
$query1 = "
        SELECT
        b.*,
        m.nama_mapel
        FROM
        bank_soal_ujian_tabel AS b
        INNER JOIN mapel_tabel AS m ON b.id_mapel = m.id_mapel
        WHERE b.id_bank_soal_ujian='$id_bank'";
$proses1 = mysql_query($query1);
$result1 = mysql_fetch_assoc($proses1);
$array_id_kartu = [];
$array_jawaban = [];
$array_jawaban_user = [];
?>

<!-- Navbarnya -->
<div class="row">
  <div id="navbar-soal">
      <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
        <table width="100%">
        <tbody>
          <tr>
            <td>NIS</td>
            <td>: <?php echo $result_siswa['nomor']; ?></td>
          </tr>
          <tr>
            <td>Nama</td>
            <td>: <?php echo $result_siswa['nama_siswa']; ?></td>
          </tr>
          <tr>
            <td>Kelas</td>
            <td>: <?php echo $result_siswa['kelas']." ".$result_siswa['jurusan']; ?></td>
          </tr>
          <tr>
            <td>Mata Pelajaran</td>
            <td>: <?php echo $result1['nama_mapel']; ?></td>
          </tr>
        </tbody>
      </table>
      </div>
    </div>
</div>

<div class="row" id="contentnya">
  
  <!-- Buat Soal dan Jawaban -->
  <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
    <div id="soal_dragend">
    <?php 
    $query2 = "
            SELECT
            i.id_bank_soal_ujian,
            k.id_kartu_soal,
            s.id_soal,
            s.soal,
            s.jawaban,
            s.jml_opsi,
            s.pembahasan,
            k.id_mapel,
            m.nama_mapel
            FROM
            isi_soal_tabel AS i
            INNER JOIN draft_kartu_tabel AS k ON i.id_kartu_soal = k.id_kartu_soal
            INNER JOIN soal_tabel AS s ON s.id_soal = k.id_soal
            INNER JOIN mapel_tabel AS m ON k.id_mapel = m.id_mapel
            WHERE i.id_bank_soal_ujian = '$id_bank'";
    $proses2 = mysql_query($query2);
    $no_soal = 1;
    
    
    while($soal = mysql_fetch_assoc($proses2)){
      array_push($array_id_kartu, $soal['id_kartu_soal']);
      array_push($array_jawaban, $soal['jawaban']);
      ?>
      <div class="dragend-page">
        <b> Soal No. <?php echo $no_soal; ?></b>
        <input type="hidden" name="input_id_soal<?php echo $soal['id_kartu_soal']; ?>" id="input_id_soal<?php echo $soal['id_kartu_soal']; ?>" value="<?php echo $soal['id_soal']; ?>">
        <br><br>
        <?php 
          echo $soal['soal']."<br><br>";
          echo "<h4 style= 'color:#26C281';>Jawaban Benar : ".$soal['jawaban']."</h4>";
        ?>
        <div style="width:100%;border:1px solid #333; padding:5px;">
        <label>Pembahasan :</label><br>
        <?php echo $soal['pembahasan']; ?>
      </div>
      </div>
      <?php
      $no_soal++;
    }
    ?>
    </div>
  </div>
  <!-- End soal jawaban -->
  <!-- Buat timer dan no soal -->

  <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
  <div class="panel panel-default">
    <div class="panel-body">
      <label for="divnilai">Nilai</label>
      <div id="divnilai" align="center" style="font-size:30px;"> 
        <?php 
          $qnilai = mysql_query("SELECT b.skor_nilai FROM bank_hasil_ujian_tabel AS b WHERE b.id_siswa = '$id_user' AND b.id_bank_soal_ujian = '$id_bank'"); 
          $rnilai = mysql_fetch_assoc($qnilai);
          echo $rnilai['skor_nilai'];
          ?>
      </div>
    </div>
  </div>
    <div id="panel-kiri" class="panel panel-default">
      <div class="panel-body">
        <label>Jawaban User</label>
        <div class="row" style="padding:5px;">
          <a onclick="next_or_prev('right');" style="cursor:pointer;">
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" id="btn_next_prev"><i class="fa fa-arrow-left"></i></div>
          </a>
          <a onclick="next_or_prev('left');" style="cursor:pointer;">
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" id="btn_next_prev"><i class="fa fa-arrow-right"></i></div>
          </a>
        </div>

      <?php 
          $query_jwb_user =mysql_query("SELECT
                      pilihan_jawab_tabel.jawaban
                      FROM
                      pilihan_jawab_tabel
                      WHERE
                      pilihan_jawab_tabel.id_siswa = '$id_user'  AND
                      pilihan_jawab_tabel.id_bank_soal_ujian = '$id_bank'");
          while($r_jwb_user = mysql_fetch_assoc($query_jwb_user)){
            array_push($array_jawaban_user, $r_jwb_user['jawaban']);
          }
       ?>

        <div class="row" style="padding:5px;overflow:auto;height:150px;">
          <?php $no = 1; $index=0; ?>
          <?php foreach ($array_id_kartu as $kartu) { ?>
                  <a onclick="goto_soal(<?php echo $no; ?>);" style="cursor:pointer;">
                    <?php 
                    $jb = $array_jawaban[$index];
                    $ju = $array_jawaban_user[$index];
                    if($ju == $jb){
                      ?>
                        <div id="id_no_soal<?php echo $no; ?>" class="a_no_soal col-xs-3 col-sm-3 col-md-3 col-lg-3" style="background-color:#26A65B;"><?php echo $no.'. '.$ju;?></div>
                      <?php
                    }else {
                      ?>
                        <div id="id_no_soal<?php echo $no; ?>" class="a_no_soal col-xs-3 col-sm-3 col-md-3 col-lg-3"><?php echo $no.'. '.$ju;?></div>
                      <?php
                    }
                    ?>
                </a>
          <?php 
          $no++;
          $index++;
          } ?>
        </div>
        
      </div>

    </div>
    <button id="tombol_kembali" type="button" class="btn btn-default btn-sm" style="background-color:#3498DB;color:#fff;width:100%;" onclick="kembali();">Kembali</button>
  </div>
</div>




