<?php
//----------------------------------------------
require "../../../../config/classDB.php";
$conn = new Database();
//----------------------------------------------
$nama_instansi = $_POST['input_nama_instansi'];
$set = array('nama_instansi'=>$nama_instansi);
$where = [];

$proses_edit = $conn->update('tema', $set, $where);
if($proses_edit){
    ?>
        <script>
            window.top.window.hasil_edit_instansi("oke");
        </script>
    <?php
}else{
    ?>
    <script>
        window.top.window.hasil_edit_instansi('Gagal edit !');
    </script>
<?php
}
?>