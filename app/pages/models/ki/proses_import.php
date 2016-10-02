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
    $nama_kompetensi_inti = $data->sheets[0]["cells"][$i][1];
    $values = array("nama_kompetensi_inti"=>$nama_kompetensi_inti);
    $hasil = $conn->insert("kompetensi_inti_tabel", $values);
}
$pesan = ($hasil)? "oke_tambah" : "Gagal !";
?>
 <script>
        window.top.window.hasil_simpan('<?php echo $pesan; ?>');
    </script>