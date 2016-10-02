<?php
//----------------------------------------------
define('UPLOAD_DIR', 'dist/img/soal/');
require "../../../../config/classDB.php";
$conn = new Database();
//----------------------------------------------

$jenisproses = $_POST['jenisproses'];
$idprimarykeykartu = $_POST['idprimarykey'];
$input_id_smt = $_POST['input_id_smt'];
$input_id_mapel = $_POST['input_id_mapel'];
$input_id_ki = $_POST['input_id_kinti'];
$input_id_guru = $_POST['input_id_guru'];
$input_id_tapel = $_POST['input_id_tapel'];
$input_id_kd = $_POST['input_id_kdasar'];
$input_id_materi = $_POST['input_id_mteri'];
$input_indikator = $_POST['input_id_indikator'];
$input_id_buku = $_POST['input_buku'];
$input_new_buku = $_POST['nama_new_buku'];
$input_no_soal = $_POST['input_new_no'];
$input_id_isi_soal = str_replace("'", "`", $_POST['input_id_isi_soal']);
$input_jawaban = $_POST['input_id_jawaban'];
$input_opsi = $_POST['input_id_bentuk_tes'];

$sel = $conn->fetch("SELECT id_soal FROM soal_tabel ORDER BY id_soal DESC LIMIT 0,1");
if(count($sel) > 0){
	$no_sl = $sel[0]['id_soal'] + 1;
}else{
	$no_sl = 1;
}

//INPUT AUDIO
$folder_simpan = '../../../../dist/file/audio/';
$music = $_FILES['input_audio']['name'];

$nama_music = pathinfo($music,PATHINFO_FILENAME);
$ext_music = pathinfo($music,PATHINFO_EXTENSION);
$ix = 1;
while(file_exists($folder_simpan.$nama_music."($ix)".'.'.$ext_music)){
    $ix++;
}
$nama_audio = $nama_music."($ix)".'.'.$ext_music;
$music_simpan = $folder_simpan.basename($nama_audio);


//CEK BUKU
if($input_new_buku !== "-"){
	$values_buku = array('judul_buku'=>$input_new_buku);
	$p_insert_new_buku = $conn->insert("buku_tabel", $values_buku);
}

$doc = new DOMDocument();
$doc->loadHTML($input_id_isi_soal);
$doc->preserveWhiteSpace = false;
$images = $doc->getElementsByTagName('img');

//Cek Gambar
if($images->length > 0){
	$src_img_before = array();
	$src_img_after = array();

	foreach ($images as $img) {
		$src = $img->getAttribute('src'); 
			array_push($src_img_before, $src);
			$bs64img = str_replace('data:image/png;base64,', '', $src);
			$bs64img = str_replace(' ', '+', $bs64img);

			$imageData = base64_decode($bs64img);
			
			$name_image = "image".$input_id_mapel;

			$im = 1;
			if(!file_exists("../../../../" . UPLOAD_DIR . $no_sl)){
				mkdir("../../../../" . UPLOAD_DIR . $no_sl , 0777, true);
			}

			while(file_exists("../../../../" . UPLOAD_DIR . $no_sl . "/" . $name_image."($im)".'.png')){
			    $im++;
			}

			$new_name_image = $name_image."($im)"; 

			$file_upload = "../../../../" . UPLOAD_DIR . $no_sl . "/" . $new_name_image . '.png';
			$file_db = "../" . UPLOAD_DIR . $no_sl . "/" . $new_name_image . '.png';
			array_push($src_img_after, $file_db);
			$success = file_put_contents($file_upload, $imageData);
		
		
	}

	// echo '<pre>';
	// print_r($src_img_before);
	// print_r($src_img_after);
	// echo '</pre>';
	$i = 0;
	while($i < count($src_img_after)){
		$input_id_isi_soal = str_replace($src_img_before[$i], $src_img_after[$i], $input_id_isi_soal);
		$i++;
	}
}

//echo htmlentities($input_id_isi_soal);

//PROSES SOAL
$pisah_text = explode("<p>----------</p>", $input_id_isi_soal);

$isi_soal = $pisah_text[0];
$abjad = $pisah_text[1];
$pembahasan = $pisah_text[2];

$pisah_abjad = explode("<br />", strip_tags($abjad, '<br><img>'));
$abcde = ['A','B','C','D','E'];


if($jenisproses == 'tambahdata'){
	
	
	$move_upload = true;
	//INSERT AUDIO
	if(!empty($music)){
	    $xx=move_uploaded_file($_FILES['input_audio']['tmp_name'], $music_simpan);
	    if($xx){ 
	    	$move_upload = true;
	    	$values_audio = array('file'=>$nama_audio, 'id_soal'=>$no_sl);
	    	$conn->insert("audio_soal_tabel", $values_audio);
	    }else{ 
	    	$move_upload = false; 
	    }
	}

	if($move_upload == true){
		//INSERT SOAL
		$values_soal = array('id_soal'=>$no_sl,
							'soal'=>$isi_soal,
							'jawaban'=>$input_jawaban,
							'jml_opsi'=>$input_opsi,
							'indikator_soal'=>$input_indikator,
							'pembahasan'=>$pembahasan);
		$p_insert_soal = $conn->insert("soal_tabel", $values_soal);

		//INSERT OPSI
		for ($i=0; $i < count($pisah_abjad); $i++) { 
			$isi_abjad = str_replace($abcde[$i].". ", "", $pisah_abjad[$i]);
			$values_opsi = array('isi_opsi'=>$isi_abjad, 'id_soal'=>$no_sl);
			$conn->insert("opsi_".strtolower($abcde[$i])."_tabel", $values_opsi);
		}

		if($p_insert_soal){
			
			$values_kartu = array('semester'=>$input_id_smt,
								'id_mapel'=>$input_id_mapel,
								'id_kompetensi_inti'=>$input_id_ki,
								'id_guru'=>$input_id_guru,
								'id_tahun_ajaran'=>$input_id_tapel,
								'id_kompetensi_dasar'=>$input_id_kd,
								'id_materi'=>$input_id_materi,
								'indikator'=>$input_indikator,
								'id_buku'=>$input_id_buku,
								'id_soal'=>$no_sl,
								'status_verifikasi'=>'sudah');
			$p_insert_kartu = $conn->insert('draft_kartu_tabel', $values_kartu);
			if($p_insert_soal && $p_insert_kartu){
				$pesan = 'Berhasil Tambah Soal !';
			}else{
				$pesan = 'Gagal Tambah Soal!';
			}
		}else{
			$pesan = 'Gagal Tambah Soal !';
		}
	}else{
		$pesan = 'Audio Gagal !';
	}
	
	
}elseif($jenisproses == 'editdata'){
	//UPDATE SOAL
	$set_soal = array('soal'=>$isi_soal,
					'jawaban'=>$input_jawaban,
					'jml_opsi'=>$input_opsi,
					'indikator_soal'=>$input_indikator);
	$where_soal = array('id_soal'=>$input_no_soal);
	$p_update_soal = $conn->update('soal_tabel', $set_soal, $where_soal);
	
	//UPDATE OPSI
	for ($i=0; $i < count($pisah_abjad); $i++) { 
		$isi_abjad = str_replace($abcde[$i].". ", "", $pisah_abjad[$i]);
		$set_opsi = array('isi_opsi'=>$isi_abjad);
		$where_opsi = array('id_soal'=>$input_no_soal);
		$conn->update("opsi_".strtolower($abcde[$i])."_tabel", $set_opsi, $where_opsi);
	}

	//UPDATE AUDIO
	if(!empty($music)){
	    $xx=move_uploaded_file($_FILES['input_audio']['tmp_name'], $music_simpan);
	    if($xx){ echo "success"; }else{ echo "gagal"; }
	    $select_audio = $conn->fetch("SELECT file FROM audio_soal_tabel WHERE id_soal='$input_no_soal'");
	    if(count($select_audio) > 0){
	    	$set_audio = array('file'=>$nama_audio);
		    $where_audio = array('id_soal'=>$input_no_soal);
		    $conn->update("audio_soal_tabel", $set_audio, $where_audio);
	    }else{
	    	$values_audio = array('file'=>$nama_audio, 'id_soal'=>$input_no_soal);
	    	$conn->insert("audio_soal_tabel", $values_audio);
	    }
	}

	$set_kartu = array('semester'=>$input_id_smt, 'id_mapel'=>$input_id_mapel,
												'id_kompetensi_inti'=>$input_id_ki,'id_guru'=>$input_id_guru,
												'id_tahun_ajaran'=>$input_id_tapel,'id_kompetensi_dasar'=>$input_id_kd,
												'id_materi'=>$input_id_materi,'indikator'=>$input_indikator,
												'id_buku'=>$input_id_buku,'id_soal'=>$input_no_soal,'status_verifikasi'=>'sudah');
	$where_kartu = array('id_kartu_soal'=>$idprimarykeykartu);
	$p_update_kartu = $conn->update('draft_kartu_tabel', $set_kartu, $where_kartu);
	if($p_update_soal && $p_update_kartu){
		$pesan = 'Berhasil Ubah Soal !';
	}else{
		$pesan = 'Gagal Ubah Soal !';
	}
}
?>
<script>
    window.top.window.hasil_simpan('<?php echo $pesan; ?>');
</script>