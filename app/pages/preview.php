<?php 
//----------------------------------------------
require "../../config/classDB.php";
$conn = new Database();
//----------------------------------------------

function show_image($page){
    $doc = new DOMDocument();
    $doc->loadHTML($page);
    $doc->preserveWhiteSpace = false;
    $images = $doc->getElementsByTagName('img');

    //Cek Gambar
    if($images->length > 0){
        $src_img_before = array();
        $src_img_after = array();

        foreach ($images as $img) {
            $src = $img->getAttribute('src');
            array_push($src_img_before, $src);
            $new_src = "../".$src;
            array_push($src_img_after, $new_src);
        }

        $i = 0;
        while($i < count($src_img_after)){
            $page = str_replace($src_img_before[$i], $src_img_after[$i], $page);
            $i++;
        }
    }

    return $page;
}

$idnya= $_GET['id'];
$query = "SELECT dk.id_kartu_soal, dk.id_kompetensi_inti, dk.semester, dk.indikator, dk.id_soal, s.soal,
                    s.jawaban, s.jml_opsi, s.pembahasan, m.nama_mapel, g.nama_guru,
                    th.tahun_ajaran, kd.nama_kompetensi_dasar, mtr.nama_materi, buku.judul_buku
                    FROM
                    draft_kartu_tabel AS dk
                    INNER JOIN soal_tabel AS s ON dk.id_soal = s.id_soal
                    INNER JOIN mapel_tabel AS m ON dk.id_mapel = m.id_mapel
                    INNER JOIN guru_tabel AS g ON dk.id_guru = g.id_guru
                    INNER JOIN tahun_ajaran_tabel AS th ON dk.id_tahun_ajaran = th.id_tahun_ajaran
                    INNER JOIN kompetensi_dasar_tabel AS kd ON dk.id_kompetensi_dasar = kd.id_kompetensi_dasar
                    INNER JOIN materi_tabel AS mtr ON dk.id_materi = mtr.id_materi
                    INNER JOIN buku_tabel AS buku ON dk.id_buku = buku.id_buku
                    WHERE dk.id_kartu_soal = $idnya
";

$proses = $conn->fetch($query);

foreach ($proses as $key => $result) {
    $nama_mapel = $result['nama_mapel'];
    $id_kompetensi_inti = $result['id_kompetensi_inti'];
    $semester = $result['semester'];
    $nama_guru = $result['nama_guru'];
    $jml_opsi = $result['jml_opsi'];
    $tahun_ajaran = $result['tahun_ajaran'];
    $nama_kompetensi_dasar = $result['nama_kompetensi_dasar'];
    $id_soal = $result['id_soal'];
    $jawaban = $result['jawaban'];
    $judul_buku = $result['judul_buku'];
    $soal = $result['soal'];
    $nama_materi = $result['nama_materi'];
    $indikator = $result['indikator'];
    $pembahasan = $result['pembahasan'];
}

$que_theme = $conn->fetch("SELECT * FROM tema");
foreach ($que_theme as $key => $theme) {
    $icon = $theme['icon'];
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo $icon; ?>">
    <!-- Bootstrap core CSS -->
    <link href="../../dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../dist/css/theme.css" rel="stylesheet">
    <!-- <link href="../../dist/css/bootstrap-reset.css" rel="stylesheet"> -->
    <!-- <link href="css/bootstrap.min.css" rel="stylesheet">-->

    <!--external css-->
    <link href="../../dist/assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../../dist/css/flexslider.css"/>
    <link href="../../dist/assets/bxslider/jquery.bxslider.css" rel="stylesheet" />
    <link rel="stylesheet" href="../../dist/css/animate.css">
    <link rel="stylesheet" href="../../dist/assets/owlcarousel/owl.carousel.css">
    <link rel="stylesheet" href="../../dist/assets/owlcarousel/owl.theme.css">

    <link href="../../dist/css/superfish.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="../../dist/fonts/lato.css">
    <!-- <link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'> -->
    <!-- <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'> -->


    <!-- Custom styles for this template -->
    <link rel="stylesheet" type="text/css" href="../../dist/css/component.css">
    <link href="../../dist/css/style.css" rel="stylesheet">
    <link href="../../dist/css/style-responsive.css" rel="stylesheet" />
    <script src="../../dist/js/jquery-1.8.3.min.js">
    </script>
    <style>
        body{
            padding: 10px;
        }
            td{
                padding:1px;
            }
            .tablenya{
                border: 2px solid #3c8dbc;
                border-collapse: collapse;
                width:100%;
                height:75%;
            }
            .tablenya td{
                border: 2px solid #3c8dbc;
                border-collapse: collapse;
                vertical-align: top;
                padding: 10px;
            }
    </style>
</head>
<body>


    <h2>Kartu Soal</h2>
    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-5">
       <table width="100%">
            <tr>
                <td width="30%">Mata Pelajaran</td>
                <td width="10%" align="center">:</td>
                <td width="60%"><?php echo $result['nama_mapel']; ?></td>
            </tr>
            <tr>
                <td>Kompetensi Inti</td>
                <td align="center">:</td>
                <td><?php echo $result['id_kompetensi_inti']; ?></td>
            </tr>
            <tr>
                <td>Semester</td>
                <td align="center">:</td>
                <td><?php echo $result['semester']; ?></td>
            </tr>
        </table>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-4 col-md-offset-2 col-lg-5 col-lg-offset-1">
        <table width="100%">
            <tr>
                <td width="30%">Penyusun</td>
                <td width="10%" align="center">:</td>
                <td width="60%"><?php echo $result['nama_guru']; ?></td>
            </tr>
            <tr>
                <td>Bentuk Tes</td>
                <td align="center">:</td>
                <td><?php echo "Pil. Ganda ".$result['jml_opsi']; ?></td>
            </tr>
            <tr>
                <td>Tahun Pelajaran</td>
                <td align="center">:</td>
                <td><?php echo $result['tahun_ajaran']; ?></td>
            </tr>
        </table>
    </div>
    <p>
<table class="tablenya">
    <tr>
        <td rowspan="2" width="25%">
            <b>Kompetensi Dasar</b>
            <br>
            <?php echo $result['nama_kompetensi_dasar']; ?>
        </td>
        <td width="10%" style="height:20px;">
            <b>ID Soal</b><p>
            <center><?php echo $result['id_soal']; ?></center>
        </td>
        <td>
            <b>Kunci Jawaban</b><br>
            <center><?php echo $result['jawaban']; ?></center>
        </td>
        <td>
            <b>Buku Sumber</b>
            <br>
            <?php echo $result['judul_buku']; ?>
        </td>
    </tr>
    <tr>
        <td colspan="3" rowspan="3">
            <b>Rumusan Butir Soal</b><br>
            <?php
                $abcde = ['a','b','c','d','e']; 

                //cek audio
                $query_audio = $conn->fetch("SELECT * FROM audio_soal_tabel WHERE id_soal = $id_soal");
                if(count($query_audio) > 0){
                    foreach ($query_audio as $key => $Music) {
                        ?><audio controls="controls" src="../../dist/file/audio/<?php echo $Music['file']; ?>"></audio><?php
                    }
                }

                $id_isi_soal = $result['soal'];

                echo show_image($id_isi_soal)."<br>";
                for ($i=0; $i < $result['jml_opsi']; $i++) { 
                    echo strtoupper($abcde[$i]).". ";
                    $sel = $conn->fetch("SELECT isi_opsi FROM opsi_".$abcde[$i]."_tabel WHERE id_soal='$id_soal'");
                    foreach ($sel as $key => $r_sel) {
                        echo show_image($r_sel['isi_opsi'])."<br>";
                    }
                } 
            ?>
        </td>
    </tr>
    <tr>
        <td height="150px">
            <b>Materi</b>
            <br>
            <?php echo $result['nama_materi']; ?>
        </td>
    </tr>
    <tr>
        <td height="150px">
            <b>Indikator Soal</b>
            <br>
            <?php echo $result['indikator']; ?>
        </td>
        <tr>
            <td colspan="8" id='td_pembahasan'>
                    <b>Pembahasan</b><br>
                   <?php echo show_image($result['pembahasan']); ?>
            </td>
        </tr>
    </tr>
</table>
<script src="../../dist/js/bootstrap.min.js">
    </script>
</body>
</html>
