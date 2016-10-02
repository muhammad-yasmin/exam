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

<div id="div_soalnya" style="width:100%;height:300px; overflow:auto;">
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

