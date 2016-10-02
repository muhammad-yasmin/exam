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

$id_bank = $_GET['id'];

$query_bank = $conn->fetch("
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
				");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<style type="text/css" media="print">
		
		body{
			font-family: Arial;
		}
		table,tr,td{
			border: 1px solid black;
			border-collapse: collapse;
		}
	</style>
	<script src="../../dist/js/jquery-1.8.3.min.js">
    </script>
</head>
<body>
	<div id="div_soalnya">
		<?php 
			$abcde = ['a','b','c','d','e'];
			foreach ($query_bank as $key => $result) {
				?>
				<b> ID Soal : <?php echo $result['id_soal']; ?></b>
				<br>
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

	<script>
		$(document).ready(function(){
			window.print();
		});
	</script>
</body>
</html>
