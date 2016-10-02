<?php
//----------------------------------------------
require "../../../../config/classDB.php";
$conn = new Database();
//----------------------------------------------
$input_name = $_POST['name'];
$input_email = $_POST['EMAIL'];
$input_pesan= $_POST['pesan'];

$values = array('nama'=>$input_name, 'email'=>$input_email, 'isi'=>$input_pesan, 'tanggal'=>date('Y-m-d'));
$proses1 = $conn->insert('kotak_pesan', $values);

if($proses1){
		?>
            <script>
                window.top.window.hasil_simpan('Berhasil Kirim !');
            </script>
        <?php
	}else{
		?>
            <script>
                window.top.window.hasil_simpan('Gagal Kirim !');
            </script>
        <?php
	}



?>