<?php
//----------------------------------------------
require "../../../connection/classdatabase.php";
$connect = new classdb;
$connect->koneksidb();
//----------------------------------------------
$id_siswa = $_POST['input_id_siswa'];
$id_bank_soal = $_POST['input_id_bank'];
$jml_soal = $_POST['input_jumlah_soal'];
$yang_benar = 0;
$yang_salah = 0;
$yang_tidak_dijawab = 0;
$nilai = 0;
$array_id_kartu = [];

//SELECT
$load_kartu = mysql_query("SELECT b.id_kartu_soal FROM isi_soal_tabel b WHERE id_bank_soal_ujian='$id_bank_soal'");
while ($res = mysql_fetch_assoc($load_kartu)) {
	$k = $res['id_kartu_soal'];
	array_push($array_id_kartu, $k);
	if(!isset($_POST['radio_jawab'.$id_bank_soal.'_'.$k])){
		$yang_tidak_dijawab++;
	}else{
		foreach ($_POST['radio_jawab'.$id_bank_soal.'_'.$k] as $jawabannya) {
		    $id_soal = $_POST['input_id_soal'.$k];
		    $query_cek_jwb = mysql_query("SELECT * FROM soal_tabel WHERE id_soal='$id_soal'");
		    $result = mysql_fetch_assoc($query_cek_jwb);
		    if($result['jawaban'] == $jawabannya){
		    	$yang_benar++;
		    }else{
		    	$yang_salah++;
		    }
		}
	}
}

//Rumusnya
$nilai = ($yang_benar/$jml_soal) * 100;

echo "ID SISWA : ".$id_siswa."<br>";
echo "ID Bank : ".$id_bank_soal."<br>";
echo "Yang Benar : ".$yang_benar."<br>";
echo "Yang Salah : ".$yang_salah."<br>";
echo "Tidak dijawab : ".$yang_tidak_dijawab."<br>";
echo "Sekor : ".$nilai;


$query_kkm = mysql_query("SELECT * FROM pengaturan_nilai_tabel WHERE id_bank_soal_ujian='$id_bank_soal'");
$kkm = mysql_fetch_assoc($query_kkm);

if($nilai >= $kkm['nilai_minimal']){
	$keterangan = "LULUS";
}else{
	$keterangan = "REMIDI";
}

$query_hasil = "INSERT INTO bank_hasil_ujian_tabel VALUES(
							DEFAULT,
							'$id_siswa',
							'$id_bank_soal',
							NOW(),
							'$yang_benar',
							'$yang_salah',
							'$yang_tidak_dijawab',
							'$nilai',
							'$keterangan'
							)";
$proses_hasil = mysql_query($query_hasil);

foreach ($array_id_kartu as $kartu) {
	$jawaban = $_COOKIE['soal'.$id_bank_soal.'_'.$kartu];
	$query_jawaban = mysql_query("INSERT INTO pilihan_jawab_tabel VALUES(DEFAULT,'$id_siswa','$id_bank_soal','$kartu','$jawaban')");
}

if($proses_hasil && $query_jawaban){
	foreach ($array_id_kartu as $kartu) {
		?>
		<script>
			window.top.window.delete_cookies_jawaban(<?php echo $id_bank_soal; ?>,<?php echo $kartu; ?>);
		</script>
		<?php
	}
	?>
	<script>
		window.top.window.hasil_ujian("berhasil",<?php echo $nilai; ?>);
	</script>
	<?php
	
}else{
	?>
	<script>
		window.top.window.hasil_ujian("gagal",<?php echo $nilai; ?>);
	</script>
	<?php
}
?>
