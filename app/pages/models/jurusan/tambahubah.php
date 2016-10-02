<?php
//----------------------------------------------
require "../../../../config/classDB.php";
$conn = new Database();
//----------------------------------------------

$jenis_proses = $_POST['jenis_proses'];
$idprimarykey = $_POST['idprimarykey'];

$input_id_nama_jurusan = $_POST['input_id_nama_jurusan'];


if($jenis_proses == 'tambahdata'){
    $KolomValues = array('jurusan'=>$input_id_nama_jurusan);
    
    $proses_tambah = $conn->insert("jurusan_tabel", $KolomValues);
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
    
    $set = array('jurusan'=>$input_id_nama_jurusan);
    $where = array('id_jurusan'=>$idprimarykey);

    $proses_edit = $conn->update('jurusan_tabel', $set, $where);
    
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