<?php
//----------------------------------------------
require "../../../../config/classDB.php";
$conn = new Database();
//----------------------------------------------

//BUAT INPUT GAMBAR
$folder_simpan = '../../../../dist/img/logo/';
$folder = 'dist/img/logo/';
$gambar = $_FILES['input_id_logo']['name'];
$gambar_jenis = $_FILES['input_id_logo']['type'];

$nama_gmbr = "logo_apl";
$ext_gmbr = "png";
$i = 1;
while(file_exists($folder_simpan.$nama_gmbr."($i)".'.'.$ext_gmbr)){
    $i++;
}
$nama_jadi = $nama_gmbr."($i)".'.'.$ext_gmbr;
$gambar_simpan = $folder_simpan.basename($nama_jadi);
//-----------------
if(!empty($gambar)){
    move_uploaded_file($_FILES['input_id_logo']['tmp_name'], $gambar_simpan);
    $folderdanfoto = $folder.$nama_jadi;

    if($gambar_jenis == 'image/jpg' || $gambar_jenis == 'image/jpeg' || $gambar_jenis == 'image/png'){  
            $set = array('logo'=>$folderdanfoto);
            $where = [];         
            $proses_edit = $conn->update('tema', $set, $where);
            if($proses_edit){
                $pesan = 'oke';
            }else{
                $pesan = 'Gagal edit !';
            }
        }else{//jika jenis gambar tidak sesuai
            $pesan = 'Format File Tidak Sesuai !';
        }
}else{
    $pesan = 'tidak ada !';
}
?>
<script>
    window.top.window.hasil_edit_logo("<?php echo $pesan ?>");
</script>