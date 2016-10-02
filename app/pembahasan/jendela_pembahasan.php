<?php 
  date_default_timezone_set('Asia/Jakarta'); 
  error_reporting(0);
  $id_user = $_SESSION['id_usernya'];
  $id_bank = $id_bank_ujian;
  $_SESSION['id_bank_nya'] = $id_bank;

  //Data Siswa
  $query_siswa = "SELECT siswa_tabel.*, jurusan_tabel.jurusan FROM siswa_tabel INNER JOIN jurusan_tabel ON siswa_tabel.id_jurusan = jurusan_tabel.id_jurusan WHERE id_siswa = $id_user";
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
            draft_kelas_tabel.id_siswa = $id_user
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
    WHERE b.id_bank_soal_ujian=$id_bank
  ";
  $proses1 = $conn->fetch($query1);
  foreach ($proses1 as $key => $result1) {
    $Nama_Mapel     = $result1['nama_mapel'];
    $NamaUjian      = $result1['nama_ujian'];
    $Penyusun       = $result1['nama_guru'];
    $Jumlah_Soal    = $result1['jumlah_soal'];
  }

  $array_no_kartu = [];
  $array_jawaban = [];
  $array_jawaban_user = [];
  
  $query_kartu = $conn->fetch("SELECT i.id_kartu_soal FROM isi_soal_tabel i 
                                    WHERE i.id_bank_soal_ujian = $id_bank");
  foreach ($query_kartu as $key => $c) {
    array_push($array_no_kartu, $c['id_kartu_soal']);
    $query_jawaban = $conn->fetch("SELECT s.jawaban FROM draft_kartu_tabel AS dk INNER JOIN soal_tabel AS s ON dk.id_soal = s.id_soal WHERE dk.id_kartu_soal = ".$c['id_kartu_soal']);
    foreach ($query_jawaban as $key => $value) {
      array_push($array_jawaban, $value['jawaban']);
    }
  }

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
          <a class="navbar-brand" href="#">ID SOAL : <?php echo $id_bank; ?></a>
        </div>
        <div class="collapse navbar-collapse">
          <form class="navbar-form navbar-right">
            <button type="button" class="btn btn-primary active" onclick="toggle_no();"><i class="fa fa-th"></i> No. Soal</button>
          </form>
        </div><!-- /.navbar-collapse -->
      </div>
    </nav>
    <nav class="navbar navbar-default navbar-fixed-bottom" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle btn btn-primary" onclick="kembali();"><i class="fa fa-arrow-left"></i> Kembali</button>
          <a class="navbar-brand" href="#"><?php echo $nama_instansi; ?></a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse">
          <form class="navbar-form navbar-right">
            <button type="button" id="tombol_submit" class="btn btn-primary" onclick="kembali();"><i class="fa fa-arrow-left"></i> Kembali</button>
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
                Nilai : <?php 
                $qnilai = $conn->fetch("SELECT b.skor_nilai FROM bank_hasil_ujian_tabel AS b WHERE b.id_siswa = $id_user AND b.id_bank_soal_ujian = $id_bank"); 

                foreach ($qnilai as $key => $rnilai) {
                  echo $rnilai['skor_nilai'];
                }

                ?>
              </div>
            </div>
            <div class="panel-body" style="background: #aaa;">
              <?php 
              $no = 1; $index = 0;
              foreach ($array_no_kartu as $key => $IDKartu) { 
                ?>
                <a onclick="goto_soal(<?php echo $no; ?>);" style="cursor: pointer;">
                  <?php
                    $jb = $array_jawaban[$index];
                    $ju = strtoupper($array_jawaban_user[$index]);
                    if($ju == $jb){
                  ?>
                  <div id="id_no_soal<?php echo $no; ?>" class="a_no_soal col-xs-3 col-sm-3 col-md-3 col-lg-3" style="background-color:#26A65B;"><?php echo $no.". ".$ju; ?></div>
                  <?php }else{ ?>
                  <div id="id_no_soal<?php echo $no; ?>" class="a_no_soal col-xs-3 col-sm-3 col-md-3 col-lg-3"><?php echo $no.". ".$ju; ?></div>
                  <?php } ?>
                </a>
              <?php 
                $no++;$index++;
              } ?>
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
        <div class="container">
          <div id="soal_dragend">
            <?php
            $no_soal = 1;$index_u = 0;
            $abcde = ['a','b','c','d','e'];
            foreach ($array_no_kartu as $key => $IDKartu) {
              $query_soal = $conn->fetch("SELECT
                                    dk.id_soal,
                                    s.soal,
                                    s.jawaban,
                                    s.pembahasan
                                    FROM
                                    draft_kartu_tabel AS dk
                                    INNER JOIN soal_tabel AS s ON dk.id_soal = s.id_soal
                                    WHERE dk.id_kartu_soal = '$IDKartu'
                                    ");
              foreach ($query_soal as $key => $soal) {
                $IDSoal       = $soal['id_soal'];
                $IsiSoal      = $soal['soal'];
                $Jawaban      = $soal['jawaban'];
                $Pembahasan   = $soal['pembahasan'];
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
                        $query_audio = $conn->fetch("SELECT * FROM audio_soal_tabel WHERE id_soal = $IDSoal");
                        if(count($query_audio) > 0){
                            foreach ($query_audio as $key => $Music) {
                              ?>
                              <audio id="myplayer<?php echo $IDSoal; ?>" controls="controls" preload="none">
                                  <source src='../dist/file/audio/<?php echo $Music['file']; ?>' />
                                </audio>
                              <?php
                            }
                        }
                        echo $IsiSoal; 
                      ?>
                    </p>
                    <p>
                      <?php
                      
                      foreach ($abcde as $key => $opsi) {
                        $query_opsi = $conn->fetch("SELECT * FROM opsi_".$opsi."_tabel WHERE id_soal=$IDSoal");
                        foreach ($query_opsi as $key => $value_opsi) {
                          ?>
                          <div class="radio">
                              <label class="label-radio">
                              <?php if(strtolower($array_jawaban[$index_u]) == $opsi){ ?><span class="benar" ><?php } else if($array_jawaban_user[$index_u] == $opsi){ ?><span class="checked" ><?php } else {?><span><?php } ?>
                                  <?php echo strtoupper($opsi); ?></span>
                                  <?php echo $value_opsi['isi_opsi']; ?>
                              </label>
                            </div>
                          <?php
                        }

                      }
                      ?>
                    </p>
                    <hr>
                    <p>
                      <b>Pembahasan :</b><br>
                      <?php echo $Pembahasan; ?>
                    </p>
                  </div>
                  <div class="panel-footer">
                    <div class="pull-right">
                      <?php if($no_soal == $Jumlah_Soal){ ?>
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
              $no_soal++;$index_u++;
            }
            ?>
          </div>
        </div>
      </div>

      
    </div>

    <script src="../dist/buat_ujian/js/jquery.min.js"></script>
    <script src="../dist/buat_ujian/js/bootstrap.min.js"></script>
    <script src="../plugins/dragend/dragend.min.js"></script>
    <script src="../plugins/jQueryUI/jquery-ui-1.10.3.min.js"></script>
    <script type="text/javascript">
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
        function toggle_no(){
          $("#page_wrap").toggleClass('toggled');
        }
       function kembali(){
        window.location = "<?php echo $base_url."/hasil"; ?>";
       }
    </script>
  </body>
</html>