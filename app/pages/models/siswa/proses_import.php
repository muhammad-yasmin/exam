<?php
//----------------------------------------------
require "../../../../config/classDB.php";
$conn = new Database();
//----------------------------------------------
include "../../excel_reader2.php";
// file yang tadinya di upload, di simpan di temporary file PHP, file tersebut yang kita ambil
// dan baca dengan PHP Excel Class
$data = new Spreadsheet_Excel_Reader($_FILES['input_id_import']['tmp_name']);
$hasildata = $data->rowcount($sheet_index=0);
// default nilai 
$sukses = 0;
$gagal = 0;

for ($i=2; $i<=$hasildata; $i++)
{
         $nomor= $data->sheets[0]["cells"][$i][2];
         $nama_siswa = $data->sheets[0]["cells"][$i][3];
         $jenis_kelamin = $data->sheets[0]["cells"][$i][4];
         $kelas = $data->sheets[0]["cells"][$i][5];
         $id_jurusan = $data->sheets[0]["cells"][$i][6];
         $ps = "12345";
         $password = md5("pass".$ps."word");
         $level = "3";
         $image = "dist/img/foto/siswa/default.png";

         $values = array('nomor'=>$nomor, 
                            'nama_siswa'=>$nama_siswa,
                            'jenis_kelamin'=>$jenis_kelamin,
                            'kelas'=>$kelas,
                            'id_jurusan'=>$id_jurusan,
                            'password'=>$password,
                            'level'=>$level,
                            'foto'=>$image);
        $hasil = $conn->insert("siswa_tabel", $values);
}
 if($hasil){
        ?>
            <script>
                window.top.window.hasil_simpan('Berhasil Import Siswa !');
            </script>
        <?php
    }else{
        ?>
        <script>
            window.top.window.hasil_simpan('Gagal Import Siswa !');
        </script>
    <?php
    }
?>