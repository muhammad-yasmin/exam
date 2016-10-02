<?php
//----------------------------------------------
require "../../../../config/classDB.php";
$conn = new Database();
//----------------------------------------------

$jenis_proses = $_POST['jenis_proses'];
$idprimarykey = $_POST['idprimarykey'];
//$hasilceknip = $_POST['hasilceknip'];
$hasilceknip = "benar";

$input_id_nip = $_POST['input_id_nip'];
$input_id_nama_guru = $_POST['input_id_nama_guru'];
$input_id_jk = $_POST['input_id_jk'];
$input_id_jurusan = $_POST['input_id_jurusan'];
$input_id_pass = md5('passguruword');
$input_id_level = 2;

//BUAT INPUT GAMBAR
$folder_simpan = '../../../../dist/img/foto/guru/';
$folder = 'dist/img/foto/guru/';
$gambar = $_FILES['input_id_foto']['name'];
$gambar_jenis = $_FILES['input_id_foto']['type'];

$nama_gmbr = $input_id_nip;
$ext_gmbr = "png";
$i = 1;
while(file_exists($folder_simpan.$nama_gmbr."($i)".'.'.$ext_gmbr)){
    $i++;
}
$nama_jadi = $nama_gmbr."($i)".'.'.$ext_gmbr;
$gambar_simpan = $folder_simpan.basename($nama_jadi);
//-----------------

if($jenis_proses == "tambahdata"){
    if(!empty($gambar)){
        move_uploaded_file($_FILES['input_id_foto']['tmp_name'], $gambar_simpan);
        $folderdanfoto = $folder.$nama_jadi;
        if($gambar_jenis == 'image/jpg' || $gambar_jenis == 'image/jpeg' || $gambar_jenis == 'image/png'){
            $cek_format = "oke";
        }else{
            $cek_format = "no";
        }
    }else{
        $folderdanfoto = $folder."default.png";
        $cek_format = "oke";
    }
    
    if($cek_format == 'oke'){
        $sel_guru = $conn->fetch("SELECT id_guru FROM guru_tabel ORDER BY id_guru DESC LIMIT 0,1");
        foreach ($sel_guru as $key => $res_sel) {
           $h_id_guru = $res_sel['id_guru'] + 1;
        }
        $values = array('id_guru'=>$h_id_guru,
                        'nomor'=>$input_id_nip,
                        'nama_guru'=>$input_id_nama_guru,
                        'jenis_kelamin'=>$input_id_jk,
                        'password'=>$input_id_pass,
                        'level'=>$input_id_level,
                        'foto'=>$folderdanfoto
                        );

        $proses_tambah_guru = $conn->insert("guru_tabel", $values);

        
        //tambah mapel guru
        foreach ($_POST['input_id_mapel'] as $input_id_mapel) {
            $values2 = array('id_guru'=>$h_id_guru, 'id_mapel'=>$input_id_mapel);
            $ptambah = $conn->insert("mapel_guru_tabel", $values2);
        }

        if($input_id_jurusan == 0){
            $sel_jur = $conn->fetch("SELECT * FROM jurusan_tabel");
            foreach ($sel_jur as $key => $res_jur) {
                $whi_jur = $res_jur['id_jurusan'];
                $values3 = array('id_guru'=>$h_id_guru, 'id_jurusan'=>$whi_jur);
                $que_tambah_jurusan = $conn->insert("guru_jurusan_tabel", $values3);
            }
        }else{
            $values3 = array('id_guru'=>$h_id_guru, 'id_jurusan'=>$input_id_jurusan);
            $que_tambah_jurusan = $conn->insert("guru_jurusan_tabel", $values3);
        }

        if($proses_tambah_guru && $ptambah && $que_tambah_jurusan){
            $pesan = 'Berhasil Tambah Guru !';
        }else{
            $pesan = 'Gagal Tambah Guru !';
        }
    }else{
        $pesan = 'Format tidak cocok !';
    }
}
else if($jenis_proses == "ubahdata"){
    $where = array('id_guru'=>$idprimarykey);
    if(!empty($gambar)){
        move_uploaded_file($_FILES['input_id_foto']['tmp_name'], $gambar_simpan);
        $folderdanfoto = $folder.$nama_jadi;
        if($gambar_jenis == 'image/jpg' || $gambar_jenis == 'image/jpeg' || $gambar_jenis == 'image/png'){
            if(isset($_POST['cek_ganti_pass'])){
                $set = array('nomor'=>$input_id_nip, 'nama_guru'=>$input_id_nama_guru, 'jenis_kelamin'=>$input_id_jk, 'foto'=>$folderdanfoto, 'password'=>$_POST['cek_ganti_pass']);
            }else{
                $set = array('nomor'=>$input_id_nip, 'nama_guru'=>$input_id_nama_guru, 'jenis_kelamin'=>$input_id_jk, 'foto'=>$folderdanfoto);
            }
           
            $cek_format = "oke";
        }else{
            $cek_format = "no";
        }
    }else{
        if(isset($_POST['cek_ganti_pass'])){
            $set = array('nomor'=>$input_id_nip, 'nama_guru'=>$input_id_nama_guru, 'jenis_kelamin'=>$input_id_jk, 'password'=>$_POST['cek_ganti_pass']);
        }else{
            $set = array('nomor'=>$input_id_nip, 'nama_guru'=>$input_id_nama_guru, 'jenis_kelamin'=>$input_id_jk);
        }
        
        $cek_format = "oke";
    }
    if($cek_format == "oke"){
        $proses_edit_guru = $conn->update("guru_tabel", $set, $where);
        if($proses_edit_guru){
            $pesan = 'Berhasil Ubah Data !';
        }else{
            $pesan = 'Gagal Ubah Data !';
        }
    }else{
        $pesan = 'Format tidak cocok !';
    }
}

?>
<script>
                window.top.window.hasil_simpan('<?php echo $pesan; ?>');
            </script>