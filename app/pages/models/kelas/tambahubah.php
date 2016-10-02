<?php
//----------------------------------------------
require "../../../../config/classDB.php";
$conn = new Database();
//----------------------------------------------

$jenis_proses = $_POST['jenis_proses'];
$idprimarykey = $_POST['idprimarykey'];

$input_tingkat = $_POST['input_tingkat'];
$input_nama_kelas = $_POST['input_nama_kelas'];
$input_tapel    = $_POST['input_id_tapel'];
$input_id_guru  = $_POST['input_id_guru'];
$array_id_siswa = [];
foreach ($_POST['input_id_siswa'] as $siswa) {
    array_push($array_id_siswa, $siswa);
}
$jumlah_siswa = count($array_id_siswa);

if($jenis_proses == 'tambahdata'){
    $s1 = $conn->fetch("SELECT id_kelas FROM kelas_tabel ORDER BY id_kelas DESC LIMIT 0,1");
    if(count($s1) > 0){
        foreach ($s1 as $key => $r1) {
            $new_id_kelas = $r1['id_kelas']+1;
        }
    }else{
        $new_id_kelas = 1;
    }
    
    
    $KolomValue1 = array(
                        'id_kelas'=>$new_id_kelas,
                        'tingkat'=>$input_tingkat,
                        'kelas'=>$input_nama_kelas,
                        'id_tahun_ajaran'=>$input_tapel,
                        'jumlah_siswa'=>$jumlah_siswa
                        );
    $q1 = $conn->insert("kelas_tabel", $KolomValue1);
    if($q1){
        foreach ($_POST['input_id_siswa'] as $siswa) {
            $KolomValue2 = array(
                        'id_kelas'=>$new_id_kelas,
                        'id_guru'=>$input_id_guru,
                        'id_siswa'=>$siswa,
                        );
            $q2 =  $conn->insert("draft_kelas_tabel", $KolomValue2);
        }
        if($q2){
        ?>
            <script>
                window.top.window.hasil_simpan('oke_tambah');
            </script>
        <?php
        }else{
            ?>
            <script>
                window.top.window.hasil_simpan('gagal !');
            </script>
            <?php
        }
    }else{
        ?>
        <script>
            window.top.window.hasil_simpan('gagal !');
        </script>
        <?php
    }


    

    if($q1 && $q2){
        ?>
            <script>
                window.top.window.hasil_simpan('Berhasil Tambah Kelas !');
            </script>
        <?php
    }else{
        ?>
        <script>
            window.top.window.hasil_simpan('Gagal Tambah Kelas !');
        </script>
    <?php
    }
}else if($jenis_proses == 'ubahdata'){
    $query_edit = "UPDATE jurusan_tabel SET
                        jurusan = '$input_id_nama_jurusan'
                        WHERE
                        id_jurusan = '$idprimarykey'
                  ";
    $proses_edit = mysql_query($query_edit);
    if($proses_edit){
        ?>
            <script>
                window.top.window.hasil_simpan('Berhasil Ubah Data !');
            </script>
        <?php
    }else{
        ?>
        <script>
            window.top.window.hasil_simpan('Gagal Ubah Data !');
        </script>
    <?php
    }
}
?>