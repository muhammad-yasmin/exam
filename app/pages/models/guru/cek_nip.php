<?php
//----------------------------------------------
require "../../../connection/classdatabase.php";
$connect = new classdb;
$connect->koneksidb();
//----------------------------------------------

$nip = $_POST['nip'];

$jml_char = strlen($nip);
if($jml_char == 18){
	$que_cek = mysql_query("SELECT * FROM guru_tabel WHERE nomor='$nip'");
	$nums_cek = mysql_num_rows($que_cek);

	if($nums_cek == 0){
		echo "sama";
	}else{
		echo "gak";
	}
}else if($jml_char < 18){
	echo "kurang";
}else if($jml_char > 18){
	echo "lebih";
}

?>