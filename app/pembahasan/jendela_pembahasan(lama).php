<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?php echo $icon_project; ?>">

    <title>
      Selamat Mengerjakan !
    </title>

    <!-- Bootstrap core CSS -->
    <link href="../dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../dist/css/theme.css" rel="stylesheet">
    <!-- <link href="../dist/css/bootstrap-reset.css" rel="stylesheet"> -->
    <!-- <link href="css/bootstrap.min.css" rel="stylesheet">-->

    <!--external css-->
    <link href="../dist/assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../dist/css/animate.css">


    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="../dist/css/css_buat_ujian.css">
    <link rel="stylesheet" type="text/css" href="../dist/css/component.css">
    <link href="../dist/css/style.css" rel="stylesheet">
    <link href="../dist/css/style-responsive.css" rel="stylesheet" />

    

    
  </head>

  <body>

<?php
$id_user = $_SESSION['id_usernya'];
$id_bank = $id_bank_ujian;
$_SESSION['id_bank_nya'] = $id_bank;
?>
<!-- JENDELA UJIAN -->

<?php


$query_siswa = "
SELECT
siswa_tabel.*,
jurusan_tabel.jurusan
FROM
siswa_tabel
INNER JOIN jurusan_tabel ON siswa_tabel.id_jurusan = jurusan_tabel.id_jurusan
WHERE id_siswa = $id_user";
$proses_siswa = $conn->fetch($query_siswa);
foreach ($proses_siswa as $key => $result_siswa) {
  $NIS    = $result_siswa['nomor'];
  $NamaSiswa   = $result_siswa['nama_siswa'];
  $Tingkat = $result_siswa['kelas'];
  $Jurusan  = $result_siswa['jurusan'];
}

$query_siswa2 = $conn->fetch("
          SELECT
          draft_kelas_tabel.id_draft_kelas,
          draft_kelas_tabel.id_kelas,
          draft_kelas_tabel.id_guru,
          draft_kelas_tabel.id_siswa,
          kelas_tabel.tingkat,
          kelas_tabel.kelas
          FROM
          draft_kelas_tabel
          INNER JOIN kelas_tabel ON draft_kelas_tabel.id_kelas = kelas_tabel.id_kelas
          WHERE
          draft_kelas_tabel.id_siswa = $id_user
          ");
foreach ($query_siswa2 as $key => $result_siswa2) {
  $Kelas   = $result_siswa2['kelas'];
}

$query1 = "
        SELECT
        b.*,
        m.nama_mapel
        FROM
        bank_soal_ujian_tabel AS b
        INNER JOIN mapel_tabel AS m ON b.id_mapel = m.id_mapel
        WHERE b.id_bank_soal_ujian=$id_bank
";
$proses1 = $conn->fetch($query1);
foreach ($proses1 as $key => $result1) {
  $Music          = $result1['soal_listening'];
  $Nama_Mapel     = $result1['nama_mapel'];
  $Jumlah_Soal    = $result1['jumlah_soal'];
  $LamaWaktu      = $result1['lama_waktu'];
}

$array_id_kartu = [];
$array_jawaban = [];
$array_jawaban_user = [];

if($Music !== "-"){
?>
<audio src="../dist/file/<?php echo $Music; ?>" autoplay="true"></audio>
<?php } ?>
<!-- Navbarnya -->
<div>
  <div id="navbar-soal">
      <div class="col-xs-12 col-sm-12 col-md-1 col-lg-1" align="center">
        <img src="../<?php echo $icon_project; ?>" width="80" class="img-responsive" alt="logo">
      </div>
      <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4">
        <table width="100%">
        <tbody>
          <tr>
            <td>NIS</td>
            <td>: <?php echo $NIS; ?></td>
          </tr>
          <tr>
            <td>Nama</td>
            <td>: <?php echo $NamaSiswa; ?></td>
          </tr>
          <tr>
            <td>Kelas</td>
            <td>: <?php 
              if(isset($Kelas)){
                echo $Tingkat." ".$Kelas;  
              }else{
                echo $Tingkat." ".$Jurusan;
              }
            ?></td>
          </tr>
          <tr>
            <td>Mata Pelajaran</td>
            <td>: <?php echo $Nama_Mapel; ?></td>
          </tr>
        </tbody>
      </table>
      </div>
      <div class="col-xs-6 col-sm-6 col-md-4 col-md-offset-3 col-lg-4 col-md-offset-3">
        <h1 class="text-center">ID Soal : <?php echo $id_bank; ?></h1>
      </div>
    </div>
</div>

<div id="contentnya">
	<!-- Buat Soal dan Jawaban -->
  <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10" id="div_buat_soal">
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
            WHERE i.id_bank_soal_ujian = $id_bank
            ";
    $proses2 = $conn->fetch($query2);
    $no_soal = 1;
    
    foreach ($proses2 as $key => $soal) {

      array_push($array_id_kartu, $soal['id_kartu_soal']);
      array_push($array_jawaban, $soal['jawaban']);
      ?>
      <div class="dragend-page">
        <b> Soal No. <?php echo $no_soal; ?></b>
        
        <?php 
          echo $soal['soal']."<br><br>";
          echo "<h4 style= 'color:#26C281';>Jawaban Benar : ".$soal['jawaban']."</h4>";
        ?>
        <div style="width:100%;">
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

  <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2" id="menu_samping">
  <div class="panel panel-default">
    <div class="panel-body">
      <label for="divnilai">Nilai</label>
      <div id="divnilai" align="center" style="font-size:30px;"> 
        <?php 
          $qnilai = $conn->fetch("SELECT b.skor_nilai FROM bank_hasil_ujian_tabel AS b WHERE b.id_siswa = $id_user AND b.id_bank_soal_ujian = $id_bank"); 

          foreach ($qnilai as $key => $rnilai) {
          	echo $rnilai['skor_nilai'];
          }
          
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
          $query_jwb_user = $conn->fetch("SELECT
                      pilihan_jawab_tabel.jawaban
                      FROM
                      pilihan_jawab_tabel
                      WHERE
                      pilihan_jawab_tabel.id_siswa = $id_user  AND
                      pilihan_jawab_tabel.id_bank_soal_ujian = $id_bank");
          foreach ($query_jwb_user as $key => $r_jwb_user) {
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


<!-- END : JENDELA UJIAN -->

<iframe id="upload_target" name="upload_target" src="#" style="display: none;"></iframe>


<script src="../dist/js/jquery-1.8.3.min.js">
    </script>
    <script src="../dist/js/bootstrap.min.js">
    </script>
    <script src="../dist/js/jquery-ui-1.9.2.custom.min.js"></script>
    <script src="../plugins/dragend/dragend.min.js"></script>
    <script>
        $(function(){
          $("#soal_dragend").dragend();
        })

        function goto_soal(no){
            $("#soal_dragend").dragend({
                scrollToPage: no
            });
        }
        function next_or_prev(arah){
            $("#soal_dragend").dragend(arah);
        }
       function kembali(){
        window.location = "<?php echo $base_url."/hasil"; ?>";
       }
    </script>
  </body>
</html>