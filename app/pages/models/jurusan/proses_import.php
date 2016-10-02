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
        $jurusan= $data->sheets[0]["cells"][$i][2];
        $val = array('jurusan'=>$jurusan);
        $hasil = $conn->insert('jurusan_tabel', $val);
}
 if($hasil){
        ?>
            <script>
                window.top.window.hasil_simpan('oke_tambah');
            </script>
        <?php
    }else{
        ?>
        <script>
            window.top.window.hasil_simpan('Gagal !');
        </script>
    <?php
    }
?>