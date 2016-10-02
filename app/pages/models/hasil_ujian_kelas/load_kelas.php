<option value="">--Pilih--</option>
<?php
//----------------------------------------------
require "../../../../config/classDB.php";
$conn = new Database();
//----------------------------------------------
$tingkat=$_POST['tingkat'];
$que_kelas = $conn->fetch("SELECT * FROM kelas_tabel WHERE tingkat='$tingkat'");
foreach ($que_kelas as $key => $kelas) {
            ?><option value="<?php echo $kelas['id_kelas'] ?>"><?php echo $kelas['kelas'] ?></option><?php
        }
        ?>