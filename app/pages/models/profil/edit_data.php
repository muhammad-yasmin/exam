<?php
//----------------------------------------------
require "../../../../config/classDB.php";
$conn = new Database();
//----------------------------------------------

$id_user = $_SESSION['id_usernya'];
$level = $_SESSION['level_nya'];
if($level == 1 || $level == 2){
	$akses = "guru";
}else{
	$akses = "siswa";
}

$status_pass = $_POST['status_pass'];
$input_passbaru = md5("pass".$_POST['input_passbaru']."word");


//BUAT INPUT GAMBAR
$folder_simpan = '../../../../dist/img/foto/'.$akses.'/';
$folder = 'dist/img/foto/'.$akses.'/';
$gambar = $_FILES['input_id_foto']['name'];
$gambar_jenis = $_FILES['input_id_foto']['type'];

$nama_gmbr = date("dmY")."".$akses."id".$id_user."_photo";
$ext_gmbr = "png";
$i = 1;
while(file_exists($folder_simpan.$nama_gmbr."($i)".'.'.$ext_gmbr)){
    $i++;
}
$nama_jadi = $nama_gmbr."($i)".'.'.$ext_gmbr;
$gambar_simpan = $folder_simpan.basename($nama_jadi);
//-----------------


if(!empty($gambar)){
	
    move_uploaded_file($_FILES['input_id_foto']['tmp_name'], $gambar_simpan);
    $folderdanfoto = $folder.$nama_jadi;

    if($gambar_jenis == 'image/jpg' || $gambar_jenis == 'image/jpeg' || $gambar_jenis == 'image/png'){           
    	if($status_pass == 'ganti'){
			$cek = true;
			$set = array('password'=>$input_passbaru, 'foto'=>$folderdanfoto);
		}else{
			$cek = true;
			$set = array('foto'=>$folderdanfoto);
		}
    }else{//jika jenis gambar tidak sesuai
        $cek = false;
        $pesan = "Format tidak sesuai !";
    }

}else{
	if($status_pass == 'ganti'){
		$cek = true;
		$set = array('password'=>$input_passbaru);
	}else{
		$cek = false;
		$pesan = "tidak berubah";
	}
}


if ($cek) {
	
    if($akses == 'guru'){
    	$tblName = "guru_tabel";
    	$where = array('id_guru'=>$id_user);
    }else{
    	$tblName = "siswa_tabel";
    	$where = array('id_siswa'=>$id_user);
    }

    $query = $conn->update($tblName, $set, $where);

    if($query){
    	$pesan = "oke";
    }else{
    	$pesan = "gagal";
    }
}else{
	$pesan = $pesan;
}
?>
<script>
	window.top.window.hasil_edit('<?php echo $pesan; ?>');
</script>