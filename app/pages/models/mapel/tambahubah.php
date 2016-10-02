<?php
//----------------------------------------------
require "../../../../config/classDB.php";
$conn = new Database();
//----------------------------------------------

$jenis_proses = $_POST['jenis_proses'];
$idprimarykey = $_POST['idprimarykey'];

$input_id_kelompok = $_POST['input_id_kelompok'];
$input_id_kode_mapel = $_POST['input_id_kode_mapel'];
$input_id_nama_mapel = $_POST['input_id_nama_mapel'];
$input_id_tingkat = $_POST['input_id_tingkat'];
if($input_id_tingkat == 'I' OR $input_id_tingkat == 'II' OR $input_id_tingkat == 'III' OR $input_id_tingkat == 'IV' OR $input_id_tingkat == 'V' OR $input_id_tingkat == 'VI'){
    $input_satuan_pendidikan = "SD / MI";
}else if($input_id_tingkat == 'VII' OR $input_id_tingkat == 'VIII' OR $input_id_tingkat == 'IX'){
    $input_satuan_pendidikan = "SMP / MTs";
}else{
    $input_satuan_pendidikan = $_POST['input_id_pendidikan'];
}

$input_id_jurusan = $_POST['input_id_jurusan'];

if($jenis_proses == 'tambahdata'){
    $que_select = $conn->fetch("SELECT id_mapel FROM mapel_tabel ORDER BY id_mapel DESC LIMIT 0,1");
    if(count($que_select) > 0){
        foreach ($que_select as $key => $r) {
            $id_mapel_new = $r['id_mapel'] + 1;
        }
    }else{
        $id_mapel_new = 1;
    }
    
    
    $values = array(
                "id_mapel"=>$id_mapel_new,
                "kode_mapel"=>$input_id_kode_mapel,
                "nama_mapel"=>$input_id_nama_mapel,
                "tingkat"=>$input_id_tingkat,
                "satuan_pendidikan"=>$input_satuan_pendidikan
            );
    $proses_tambah = $conn->insert("mapel_tabel", $values);
    
    $values2 = array(
                "nama_kelompok_mapel"=>$input_id_kelompok,
                "id_mapel"=>$id_mapel_new
            );
    $proses_tambah2 = $conn->insert("kelompok_mapel_tabel", $values2);

    $values3 = array('id_mapel'=>$id_mapel_new, 'id_jurusan'=>$input_id_jurusan);
    $proses_tambah3 = $conn->insert("mapel_jurusan_tabel", $values3);

    if($proses_tambah && $proses_tambah2 && $proses_tambah3){
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
    $set1 = array('kode_mapel'=>$input_id_kode_mapel, 'nama_mapel'=>$input_id_nama_mapel, 'tingkat'=>$input_id_tingkat);
    $where1 = array('id_mapel'=>$idprimarykey);
    $proses_edit = $conn->update("mapel_tabel", $set1, $where1);

    $set2 = array('nama_kelompok_mapel'=>$input_id_kelompok);
    $where2 = array('id_mapel'=>$idprimarykey);
    $proses_edit2 = $conn->update('kelompok_mapel_tabel', $set2, $where2);

    $set3 = array('id_jurusan'=>$input_id_jurusan);
    $where3 = array('id_mapel'=>$idprimarykey);
    $proses_edit3 = $conn->update('mapel_jurusan_tabel', $set3, $where3);
    

    if($proses_edit && $proses_edit2 && $proses_edit3){
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