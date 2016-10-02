<?php
//----------------------------------------------
require "../../../../config/classDB.php";
$conn = new Database();
//----------------------------------------------

$jenis_proses = $_POST['jenis_proses'];
$idprimarykey = $_POST['idprimarykey'];

$input_id_nama_ki = $_POST['input_id_nama_ki'];

if($jenis_proses == 'tambahdata'){

    $values = array("nama_kompetensi_inti"=>$input_id_nama_ki);
    $proses_tambah = $conn->insert("kompetensi_inti_tabel", $values);
    $pesan = ($proses_tambah)? "oke_tambah" : "Gagal !";

}else if($jenis_proses == 'ubahdata'){

    $set = array("nama_kompetensi_inti"=>$input_id_nama_ki);
    $where = array("id_kompetensi_inti"=>$idprimarykey);
    $proses_edit = $conn->update("kompetensi_inti_tabel", $set, $where);
    $pesan = ($proses_edit)? "oke_ubah" : "Gagal !";
        
    
}
?>
            <script>
                window.top.window.hasil_simpan('<?php echo $pesan; ?>');
            </script>