<?php
//----------------------------------------------
require "../../../../config/classDB.php";
$conn = new Database();
//----------------------------------------------

$jenis_proses = $_POST['jenis_proses'];
$idprimarykey = $_POST['idprimarykey'];

$input_id_nama_ujian = $_POST['input_id_nama_ujian'];


if($jenis_proses == 'tambahdata'){
    $KolomValues = array('nama_ujian'=>$input_id_nama_ujian);
    
    $proses_tambah = $conn->insert("nama_ujian_tabel", $KolomValues);
    if($proses_tambah){
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
}else if($jenis_proses == 'ubahdata'){
    
    $set = array('nama_ujian'=>$input_id_nama_ujian);
    $where = array('id_nama_ujian'=>$idprimarykey);

    $proses_edit = $conn->update('nama_ujian_tabel', $set, $where);
    
    if($proses_edit){
        ?>
            <script>
                window.top.window.hasil_simpan('oke_ubah');
            </script>
        <?php
    }else{
        ?>
        <script>
            window.top.window.hasil_simpan('Gagal !');
        </script>
    <?php
    }
}
?>