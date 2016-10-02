<?php
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
            $new_src = str_replace("../", "", $src);
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

//----------------------------------------------
require "../../../../config/classDB.php";
$conn = new Database();
//----------------------------------------------
$id_bank = $_POST['id_bank'];
$proses1 = $conn->fetch("
	SELECT
	b.nama_bank_soal_ujian,
	b.tingkat,
	j.jurusan,
	g.nama_guru,
	n.nama_ujian,
	b.jumlah_soal
	FROM
	bank_soal_ujian_tabel AS b
	INNER JOIN guru_tabel AS g ON b.id_guru = g.id_guru
	INNER JOIN nama_ujian_tabel AS n ON b.id_nama_ujian = n.id_nama_ujian
	INNER JOIN jurusan_tabel AS j ON b.id_jurusan = j.id_jurusan
	WHERE b.id_bank_soal_ujian = '$id_bank'
	");
$NamaBank = $proses1[0]['nama_bank_soal_ujian'];
$Tingkat = $proses1[0]['tingkat'];
$Jurusan = $proses1[0]['jurusan'];
$Guru = $proses1[0]['nama_guru'];
$Ujian = $proses1[0]['nama_ujian'];
$JmlSoal = $proses1[0]['jumlah_soal'];

?>
<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
	<div class="panel panel-default">
		<div class="panel-body">
			<div class="form-group">
				<label for="nama">Nama Bank</label>
				<input type="text" id="nama" name="nama" class="form-control" disabled="true" value="<?php echo $NamaBank; ?>">
			</div>
			<div class="form-group">
				<label for="tingkat">Kelas</label>
				<input type="text" id="tingkat" name="tingkat" class="form-control" disabled="true" value="<?php echo $Tingkat; ?>">
			</div>
			<div class="form-group">
				<label for="jurusan">Jurusan</label>
				<input type="text" id="jurusan" name="jurusan" class="form-control" disabled="true" value="<?php echo $Jurusan; ?>">
			</div>
			<div class="form-group">
				<label for="penyusun">Penyusun</label>
				<input type="text" id="penyusun" name="penyusun" class="form-control" disabled="true" value="<?php echo $Guru; ?>">
			</div>
			<div class="form-group">
				<label for="ujian">Ujian</label>
				<input type="text" id="ujian" name="ujian" class="form-control" disabled="true" value="<?php echo $Ujian; ?>">
			</div>
			<div class="form-group">
				<label for="jml">Jumlah Soal</label>
				<input type="text" id="jml" name="jml" class="form-control" disabled="true" value="<?php echo $JmlSoal; ?>">
			</div>
		</div>
	</div>
</div>
<div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
	<label>Kartu Soal</label>
	<?php

	$query_soal = "
			SELECT
i.id_bank_soal_ujian,
k.id_kartu_soal,
s.id_soal,
s.soal,
s.jawaban,
s.jml_opsi,
k.id_mapel,
m.nama_mapel
FROM
isi_soal_tabel AS i
INNER JOIN draft_kartu_tabel AS k ON i.id_kartu_soal = k.id_kartu_soal
INNER JOIN soal_tabel AS s ON s.id_soal = k.id_soal
INNER JOIN mapel_tabel AS m ON k.id_mapel = m.id_mapel
			WHERE i.id_bank_soal_ujian = $id_bank
			ORDER BY i.id_bank_soal_ujian
";

$proses_soal = $conn->fetch($query_soal);
$abcde = ['a','b','c','d','e'];
?>

<div id="div_soalnya" style="width:100%;height:400px; overflow:auto;">
	<?php 
		foreach ($proses_soal as $key => $result) {
			?>
			<b> ID Soal : <?php echo $result['id_soal']; ?></b>
			
			<?php echo show_image($result['soal']); ?>
			<p id="opsi">
				<?php
				for ($x=0; $x < $result['jml_opsi']; $x++) { 
					$select_opsi = $conn->fetch("SELECT * FROM opsi_".$abcde[$x]."_tabel WHERE id_soal='".$result['id_soal']."'");
					foreach ($select_opsi as $key => $val) {
						echo "<span>".strtoupper($abcde[$x]).". ".show_image($val['isi_opsi'])."</span><br>";
					}
				}
				?>
			</p>
			<legend>Jawaban : <?php echo $result['jawaban']; ?></legend>
			<hr>
			<?php
		}
	?>
</div>

</div>