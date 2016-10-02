<?php
 $folder_simpan = '../../../../dist/img/soal/';
$folder = '../../dist/img/soal/';
$gambar = $_FILES['file']['name'];
$gambar_jenis = $_FILES['file']['type'];

$nama_gmbr = pathinfo($gambar,PATHINFO_FILENAME);
$ext_gmbr = "png";
$i = 1;
while(file_exists($folder_simpan.$nama_gmbr."($i)".'.'.$ext_gmbr)){
    $i++;
}
$nama_jadi = $nama_gmbr."($i)".'.'.$ext_gmbr;
$gambar_simpan = $folder_simpan.basename($nama_jadi);
//-----------------
move_uploaded_file($_FILES['file']['tmp_name'], $folder_simpan.basename($nama_jadi));
echo $folder.$nama_jadi;
?>