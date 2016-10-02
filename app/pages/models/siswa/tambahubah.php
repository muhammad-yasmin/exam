<?php
//----------------------------------------------
require "../../../../config/classDB.php";
$conn = new Database();
//----------------------------------------------

$jenis_proses = $_POST['jenis_proses'];
$idprimarykey = $_POST['idprimarykey'];

$input_id_nis = $_POST['input_id_nis'];
$input_id_nama_siswa = $_POST['input_id_nama_siswa'];
$input_id_jk = $_POST['input_id_jk'];
$input_id_kelas = $_POST['input_id_kelas'];
$input_id_jurusan = $_POST['input_id_jurusan'];

$input_id_pass = md5('pass12345word');
$input_id_level = 3;

//BUAT INPUT GAMBAR
$folder_simpan = '../../../../dist/img/foto/siswa/';
$folder = 'dist/img/foto/siswa/';
$gambar = $_FILES['input_id_foto']['name'];
$gambar_jenis = $_FILES['input_id_foto']['type'];

$nama_gmbr = str_replace(" ", "", strtolower($input_id_nama_siswa));
$ext_gmbr = "png";
$i = 1;
while(file_exists($folder_simpan.$nama_gmbr."($i)".'.'.$ext_gmbr)){
    $i++;
}
$nama_jadi = $nama_gmbr."($i)".'.'.$ext_gmbr;
$gambar_simpan = $folder_simpan.basename($nama_jadi);
//-----------------


if($jenis_proses == 'tambahdata'){
    if(!empty($gambar)){
        move_uploaded_file($_FILES['input_id_foto']['tmp_name'], $gambar_simpan);
        $folderdanfoto = $folder.$nama_jadi;
        if($gambar_jenis == 'image/jpg' || $gambar_jenis == 'image/jpeg' || $gambar_jenis == 'image/png'){
            $cek_format = true;
        }else{
            $cek_format = false;
        }
    }else{
        $folderdanfoto = $folder."default.png";
        $cek_format = true;
    }

        if($cek_format){
            $values = array('nomor'=>$input_id_nis, 
                            'nama_siswa'=>$input_id_nama_siswa,
                            'jenis_kelamin'=>$input_id_jk,
                            'kelas'=>$input_id_kelas,
                            'id_jurusan'=>$input_id_jurusan,
                            'password'=>$input_id_pass,
                            'level'=>$input_id_level,
                            'foto'=>$folderdanfoto);          
            $proses_tambah = $conn->insert("siswa_tabel", $values);
            if($proses_tambah){
                $pesan = 'Berhasil Tambah Siswa !';
            }else{
                $pesan = 'Gagal Tambah Siswa !';
            }
        }else{//jika jenis gambar tidak sesuai
            $pesan = 'Format File Tidak Sesuai !';
        }

        
}else if($jenis_proses == 'ubahdata'){
    $where = array('id_siswa'=>$idprimarykey);
    if(!empty($gambar)){
        move_uploaded_file($_FILES['input_id_foto']['tmp_name'], $gambar_simpan);
        $folderdanfoto = $folder.$nama_jadi;
        if($gambar_jenis == 'image/jpg' || $gambar_jenis == 'image/jpeg' || $gambar_jenis == 'image/png'){

            if(isset($_POST['cek_ganti_pass'])){
                $set = array('nomor' => $input_id_nis,
                        'nama_siswa' => $input_id_nama_siswa,
                        'jenis_kelamin' => $input_id_jk,
                        'kelas' => $input_id_kelas,
                        'id_jurusan'=>$input_id_jurusan,
                        'foto' => $folderdanfoto,
                        'password' => $_POST['cek_ganti_pass']);
            }else{
                $set = array('nomor' => $input_id_nis,
                        'nama_siswa' => $input_id_nama_siswa,
                        'jenis_kelamin' => $input_id_jk,
                        'kelas' => $input_id_kelas,
                        'id_jurusan'=>$input_id_jurusan,
                        'foto' => $folderdanfoto);
            }
            
            $cek_format = true;
        }else{
            $cek_format = false;
        }
    }else{
        if(isset($_POST['cek_ganti_pass'])){
            $set = array('nomor' => $input_id_nis,
                        'nama_siswa' => $input_id_nama_siswa,
                        'jenis_kelamin' => $input_id_jk,
                        'kelas' => $input_id_kelas,
                        'id_jurusan'=>$input_id_jurusan,
                        'password' => $_POST['cek_ganti_pass']);
        }else{
            $set = array('nomor' => $input_id_nis,
                        'nama_siswa' => $input_id_nama_siswa,
                        'jenis_kelamin' => $input_id_jk,
                        'kelas' => $input_id_kelas,
                        'id_jurusan'=>$input_id_jurusan);
        }
        
            $cek_format = true;
    }
    if($cek_format){
        $proses_edit = $conn->update("siswa_tabel", $set, $where);
        if($proses_edit){
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