<?php
//----------------------------------------------
require "../../../../config/classDB.php";
$conn = new Database();
//----------------------------------------------

$jenis_proses = $_POST['jenis_proses'];
$idprimarykey = $_POST['idprimarykey'];

if($jenis_proses == 'tambahdata'){
    $input_id_mapel = $_POST['input_id_mapel'];
    $input_id_kd = $_POST['i_id_kd'];

    //cek no materi
    $que_cek = $conn->fetch("SELECT MAX(no_materi) as mx FROM materi_tabel WHERE id_mapel=$input_id_mapel AND id_kompetensi_dasar=$input_id_kd");
    $nums_cek = count($que_cek);
    if($nums_cek > 0){
        foreach ($que_cek as $key => $r) {
            $input_no_materi = $r['mx'] + 1;
        }
    }else{
        $input_no_materi = 1;
    }

    foreach ($_POST['input_text_materi'] as $input_text_materi) {
        $values = array('id_mapel'=>$input_id_mapel,
                        'id_kompetensi_inti'=>'3',
                        'id_kompetensi_dasar'=>$input_id_kd,
                        'no_materi'=>$input_no_materi,
                        'nama_materi'=>$input_text_materi);
        $p_insert_materi = $conn->insert("materi_tabel", $values);
        $input_no_materi++;
    }
    $pesan = ($p_insert_materi)? "Berhasil Tambah Materi Pokok !" : "Gagal Tambah Materi Pokok !";
}
else if($jenis_proses == "editdata"){
    $input_materi_edit = $_POST['input_materi_edit'];
    //UPDATE
    $set = array('nama_materi'=>$input_materi_edit);
    $where = array('id_materi'=>$idprimarykey);

    $p_update_materi = $conn->update("materi_tabel", $set, $where);

    $pesan = ($p_update_materi)? "Berhasil Ubah Data !" : "Gagal Ubah Data !";
}
    
?>
<script>
    window.top.window.hasil_simpan('<?php echo $pesan; ?>');
</script>