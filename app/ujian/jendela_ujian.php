<?php 
  date_default_timezone_set('Asia/Jakarta'); 
  error_reporting(0);
  $id_user = $_SESSION['id_usernya'];
  $id_bank = $id_bank_ujian;
  $_SESSION['id_bank_nya'] = $id_bank;

  //Data Siswa
  $query_siswa = "SELECT siswa_tabel.*, jurusan_tabel.jurusan FROM siswa_tabel INNER JOIN jurusan_tabel ON siswa_tabel.id_jurusan = jurusan_tabel.id_jurusan WHERE id_siswa = '$id_user'";
  $proses_siswa = $conn->fetch($query_siswa);
  foreach ($proses_siswa as $key => $result_siswa) {
    $NIS    = $result_siswa['nomor'];
    $NamaSiswa   = $result_siswa['nama_siswa'];
    $Tingkat = $result_siswa['kelas'];
    $Jurusan  = $result_siswa['jurusan'];
  }

  //Data Kelas
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
            draft_kelas_tabel.id_siswa = '$id_user'
            ");
  foreach ($query_siswa2 as $key => $result_siswa2) {
    $Kelas   = $result_siswa2['kelas'];
  }

  //Data Bank Soal ujian
  $query1 = "SELECT
    b.jumlah_soal,
    b.lama_waktu,
    m.nama_mapel,
    n.nama_ujian,
    g.nama_guru
    FROM
    bank_soal_ujian_tabel AS b
    INNER JOIN mapel_tabel AS m ON b.id_mapel = m.id_mapel
    INNER JOIN nama_ujian_tabel AS n ON b.id_nama_ujian = n.id_nama_ujian
    INNER JOIN guru_tabel AS g ON b.id_guru = g.id_guru
    WHERE b.id_bank_soal_ujian='$id_bank'
  ";
  $proses1 = $conn->fetch($query1);
  foreach ($proses1 as $key => $result1) {
    $Nama_Mapel     = $result1['nama_mapel'];
    $NamaUjian      = $result1['nama_ujian'];
    $Penyusun       = $result1['nama_guru'];
    $Jumlah_Soal    = $result1['jumlah_soal'];
    $LamaWaktu      = $result1['lama_waktu'];
  }

  $array_no_kartu = [];
  $array_jawaban = [];
  $array_opsi = [];
  //Data Soal
  //Jika tidak ada $_COOKIE['CookiesKartu'], maka dibuat dulu.
  if(!isset($_COOKIE['CookiesKartu'])){
    $CookiesKartu = [];
    $query_acak_kartu = $conn->fetch("SELECT i.id_kartu_soal FROM isi_soal_tabel i 
                                      WHERE i.id_bank_soal_ujian = '$id_bank'
                                      ORDER BY RAND()");
    foreach ($query_acak_kartu as $key => $c) {
      array_push($CookiesKartu, $c['id_kartu_soal']);
    }

    $value = json_encode($CookiesKartu);
    setcookie('CookiesKartu',$value,time() + (86400 * 30), "/");
    header("Refresh:0");
  }

  //menampilkan;
  $cookie = $_COOKIE['CookiesKartu'];
  $cookie = stripslashes($cookie);
  $savedArray = json_decode($cookie, true);
  $abcde_acak = ['a','b','c','d','e'];

  //Buat timer
  $aktivasi_proses = $conn->fetch("SELECT jam_aktif, fullscreen, block_text, focus FROM aktivasi_bank_soal WHERE id_bank_soal_ujian='$id_bank'");

  foreach ($aktivasi_proses as $key => $value) {
    $fullscreen = $value['fullscreen'];
    $block_text = $value['block_text'];
    $focus = $value['focus'];
    $jam_set = $value['jam_aktif'];
    $jam_now = date("H:i:s");
  }
  $lama_set = $LamaWaktu * 60;

  list($h,$m,$s) = explode(":", $jam_set);
  $dtAwal = mktime($h,$m,$s,"1","1","1");
  list($h,$m,$s) = explode(":", $jam_now);
  $dtAkhir = mktime($h,$m,$s,"1","1","1");
  $dtSelisih = $dtAkhir-$dtAwal;

  $total_waktu = $lama_set - $dtSelisih;

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../<?php echo $icon_project; ?>">

    <title>
      Selamat Mengerjakan !
    </title>

    <!-- Bootstrap core CSS -->
    <link href="../dist/buat_ujian/css/bootstrap.min.css" rel="stylesheet">

    <!--external css-->
    <link href="../dist/assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../dist/buat_ujian/css/css_ujian.css">

  </head>
  <body>
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle btn btn-primary active" onclick="toggle_no();">
            <i class="fa fa-th"></i>
          </button>
          <button type="button" class="navbar-toggle btn btn-primary" id="countdown_toggle"><i class="glyphicon glyphicon-refresh"></i></button>
          <a class="navbar-brand" href="#">ID SOAL : <?php echo $id_bank; ?></a>
        </div>
        <div class="collapse navbar-collapse">
          <form class="navbar-form navbar-right">
            <button type="button" class="btn btn-primary" id="countdown" style="font-size:16px;"></button>
            <button type="button" class="btn btn-primary active" onclick="toggle_no();"><i class="fa fa-th"></i> No. Soal</button>
          </form>
        </div><!-- /.navbar-collapse -->
      </div>
    </nav>
    <nav class="navbar navbar-default navbar-fixed-bottom" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle btn btn-primary" onclick="selesai();"><i class="fa fa-check"></i> Selesai</button>
          <a class="navbar-brand" href="#"><?php echo $nama_instansi; ?></a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse">
          <form class="navbar-form navbar-right">
            <?php if($focus == 1){ 
              if(isset($_COOKIE['count_foul'])){
                $foul = $_COOKIE['count_foul'];
                ?><button type="button" id="btn_foul" class="btn btn-xs btn-warning">Pelanggaran : <span id="foul_count"><?php echo $foul; ?></span></button><?php
              }else{
                $foul = 0;
                ?><button type="button" id="btn_foul" class="btn btn-xs btn-primary">Pelanggaran : <span id="foul_count"><?php echo $foul; ?></span></button><?php
              }
              ?>
              
            <?php } ?>
            
            <button type="button" id="tombol_submit" class="btn btn-primary" onclick="selesai();"><i class="fa fa-check"></i> Selesai</button>
          </form>
        </div><!-- /.navbar-collapse -->
      </div>
    </nav>

    <div id="page_wrap">
      <div id="sidebar">
        <div align="center">
          <div class="panel panel-default" style="margin:3px;border: 1px solid #aaa;">
            <div class="panel-heading">
              <div class="panel-title" align="center">
                <span id="span_id_jml_soal_terjawab">0</span> / <?php echo $Jumlah_Soal; ?>
              </div>
            </div>
            <div class="panel-body" style="background: #aaa;">
              <?php 
              $no = 1;
              foreach ($savedArray as $key => $IDKartu) { 

                array_push($array_no_kartu, $IDKartu);
                $cookie_jawaban = (isset($_COOKIE['soal'.$id_bank.'_'.$IDKartu]))? $_COOKIE['soal'.$id_bank.'_'.$IDKartu] : "-";
                array_push($array_jawaban, $cookie_jawaban);

                //note : opsi belum fix

                shuffle($abcde_acak);
                $array_abjad = [];

                foreach ($abcde_acak as $key => $abjad) {
                  array_push($array_abjad, $abjad);
                }
                array_push($array_opsi, $array_abjad);
                ?>

                <a onclick="goto_soal(<?php echo $no; ?>);" style="cursor: pointer;">
                    <?php if($array_jawaban[$no-1] !== '-' ){ ?>
                  <div id="id_no_soal<?php echo $no; ?>" class="a_no_soal col-xs-3 col-sm-3 col-md-3 col-lg-3" style="background-color:#3498DB;">
                      <?php echo $no.". ".$array_jawaban[$no-1]; ?>
                    </div>
                  <?php }else{ ?>
                    <div id="id_no_soal<?php echo $no; ?>" class="a_no_soal col-xs-3 col-sm-3 col-md-3 col-lg-3">
                      <?php echo $no; ?>
                    </div>
                  <?php } ?>
                </a>
              <?php 
                $no++;
              } 
              ?>
            </div>
          </div>
        </div>
      </div>
      <div id="content_page">
        
        <div class="jumbotron" style="padding:10px;">
          <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-1 col-lg-1" align="center">
              <img src="../<?php echo $icon_project; ?>" width="80" class="img-responsive" alt="logo">
            </div>
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
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
                  </tbody>
                </table>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                  <table width="100%">
                  <tbody>
                    <tr>
                      <td>Mata Pelajaran</td>
                      <td>: <?php echo $Nama_Mapel; ?></td>
                    </tr>
                    <tr>
                      <td>Jenis Ujian</td>
                      <td>: <?php echo $NamaUjian; ?></td>
                    </tr>
                    <tr>
                      <td>Penyusun</td>
                      <td>: <?php echo $Penyusun; ?></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
        </div>
        <div class="container" id="main_content">
          <div id="soal_dragend" <?php if($block_text == 1){ ?> style="-moz-user-select: none; -webkit-user-select: none; -ms-user-select: none; user-select: none; -o-user-select: none;" unselectable="on" onselectstart="return false;" onmousedown="return false;" <?php } ?> >
            <?php
            $no_soal = 1;
            
            foreach ($savedArray as $key => $IDKartu) {
              $query_soal = $conn->fetch("SELECT
                                    dk.id_soal,
                                    s.soal,
                                    s.jml_opsi
                                    FROM
                                    draft_kartu_tabel AS dk
                                    INNER JOIN soal_tabel AS s ON dk.id_soal = s.id_soal
                                    WHERE dk.id_kartu_soal = '$IDKartu'
                                    ");
              foreach ($query_soal as $key => $soal) {
                $IDSoal       = $soal['id_soal'];
                $IsiSoal      = $soal['soal'];
                $JmlOpsi      = $soal['jml_opsi'];
              }
              ?>
              <div class="dragend-page">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <div class="panel-title">Soal No. <?php echo $no_soal; ?></div>
                  </div>
                  <div class="panel-body">
                    <p>
                    <?php 
                      //cek audio
                      $query_audio = $conn->fetch("SELECT * FROM audio_soal_tabel WHERE id_soal = '$IDSoal'");
                      if(count($query_audio) > 0){
                          foreach ($query_audio as $key => $Music) {
                              if(!isset($_COOKIE['audio_cookie_'.$IDSoal]) OR $_COOKIE['audio_cookie_'.$IDSoal] < 2){
                              ?>
                              <div class="audio-player" id="panel_audio<?php echo $IDSoal; ?>">
                                <audio id="myplayer<?php echo $IDSoal; ?>" preload="none" ontimeupdate="len(<?php echo $IDSoal; ?>);">
                                  <source src='../dist/file/audio/<?php echo $Music['file']; ?>' />
                                </audio>
                                  <div class="panel panel-default">
                                    <div class="panel-body">
                                      <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                        <button type="button" class="btn btn-primary btn-circle btn-play" id="button-play<?php echo $IDSoal; ?>" onclick="control_audio(<?php echo $IDSoal; ?>,'play');" title="Play">
                                          <i class="fa fa-play" aria-hidden="true"></i>
                                        </button>
                                        <button style="display:none;" type="button" class="btn btn-primary btn-circle btn-pause" id="button-pause<?php echo $IDSoal; ?>" onclick="control_audio(<?php echo $IDSoal; ?>,'pause');" title="Pause">
                                          <i class="fa fa-pause" aria-hidden="true"></i>
                                        </button>
                                      </div>
                                      <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10" align="center">
                                        <span class="span-audio">
                                          <button type="button" class="btn btn-primary btn-circle" id="button-volume-down" onclick="volume_down();" title="Volume Down">
                                            <i class="fa fa-volume-down" aria-hidden="true"></i>
                                          </button>
                                          <button type="button" class="btn btn-primary btn-circle" id="button-volume-up" onclick="volume_up();" title="Volume Up">
                                            <i class="fa fa-volume-up" aria-hidden="true"></i>
                                          </button>
                                          
                                        </span>
                                      </div>
                                    </div>
                                </div>
                              </div>
                              <?php
                              }
                          }
                      }
                      echo $IsiSoal; 
                      /*echo "<pre>";
                      print_r($array_opsi);
                      echo "</pre>";
                      echo $IDSoal;*/
                    ?>
                    </p>
                    <p>
                      <?php
                        $abcde = ['A','B','C','D','E'];
                        $index = 0;
                        foreach ($array_opsi[$index] as $key => $opsi) {
                          $query_opsi = $conn->fetch("SELECT * FROM opsi_".$opsi."_tabel WHERE id_soal = '$IDSoal'");
                          foreach ($query_opsi as $key => $value_opsi) { //menampilkan hasil query
                            $cookie_jawaban = (isset($_COOKIE['soal'.$id_bank.'_'.$IDKartu]))? $_COOKIE['soal'.$id_bank.'_'.$IDKartu] : "-";
                          ?>

                            <div class="radio">
                              <label class="label-radio" for="radios<?php echo $id_bank."_".$IDKartu."_".$opsi; ?>">
                                  <input type="radio" value="<?php echo $opsi.'__'.$IDSoal; ?>" 
                                    name="radio_jawab<?php echo $id_bank."_".$IDKartu; ?>[]" 
                                    onclick="jawab_soal(<?php echo $id_bank; ?>,<?php echo $no_soal; ?>,<?php echo $IDKartu; ?>,<?php echo $IDSoal; ?>,'<?php echo $opsi; ?>');" 
                                    id="radios<?php echo $id_bank."_".$IDKartu."_".$opsi; ?>" class="radios_cls<?php echo $no_soal; ?>"
                                    <?php if($cookie_jawaban == $opsi){ echo 'checked'; } ?>
                                    > 
                                  <span class="span_cls_opsi <?php if($cookie_jawaban == $opsi){ echo 'active'; } ?>" id="span_opsi<?php echo $opsi.'__'.$IDSoal; ?>"><?php echo $abcde[$index]; ?></span>
                                  <?php echo $value_opsi['isi_opsi']; ?>
                              </label>
                            </div>
                          <?php
                          $index++;  
                          }
                          
                        }
                      ?>
                    </p>
                  </div>
                  <div class="panel-footer">
                    <div class="pull-right">
                      <?php if($no_soal == count($savedArray)){ ?>
                      <button type="button" class="btn btn-sm btn-flat" onclick="next_or_prev('right')">Sebelumnya</button>
                      <?php } else if($no_soal == 1){ ?>
                      <button type="button" class="btn btn-sm btn-flat" onclick="next_or_prev('left')">Lanjut</button>
                      <?php } else { ?>
                      <button type="button" class="btn btn-sm btn-flat" onclick="next_or_prev('right')">Sebelumnya</button>
                      <button type="button" class="btn btn-sm btn-flat" onclick="next_or_prev('left')">Lanjut</button>
                      <?php } ?>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                </div>
              </div>
              <?php
              $no_soal++;
            }
            ?>
          </div>
        </div>
      </div>

      
    </div>
    <?php require "app/ujian/modal_ujian.php"; ?>
    <form role="form"
          id="form_ujian" name="form_ujian"
          action="../app/ujian/hasilnya.php" method="post"
          enctype="multipart/form-data" target="" 
      >
        <input type="hidden" id="base_url" name="base_url" value="<?php echo $base_url; ?>">
        <input type="hidden" id="ic_project" name="ic_project" value="<?php echo $icon_project; ?>">
        <input type="hidden" id="nm_instansi" name="nm_instansi" value="<?php echo $nama_instansi; ?>">
        <input type="hidden" id="input_id_siswa" name="input_id_siswa" value="<?php echo $_SESSION['id_usernya']; ?>">
        <input type="hidden" id="input_id_bank" name="input_id_bank" value="<?php echo $id_bank; ?>">
        <input type="hidden" id="input_jumlah_soal" name="input_jumlah_soal" value="<?php echo $Jumlah_Soal; ?>">
      </form>
    <iframe id="upload_target" name="upload_target" src="#" style="display: none;"></iframe>

    <script src="../dist/buat_ujian/js/jquery.min.js"></script>
    <script src="../dist/buat_ujian/js/bootstrap.min.js"></script>
    <script src="../plugins/dragend/dragend.min.js"></script>
    <script src="../plugins/jQueryUI/jquery-ui-1.10.3.min.js"></script>
    <?php require "app/ujian/ct_cookie.php"; ?>
    <?php require "app/ujian/ct_func.php"; ?>
    <?php if($focus == 1){ ?>
      <script>
        $(document).ready(function () {
                $(window).on('blur', function () {
                  pelanggaran();
                });
              });
      </script>
      <?php } ?>
  </body>
</html>