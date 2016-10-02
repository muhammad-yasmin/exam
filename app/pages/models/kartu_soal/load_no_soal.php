<?php
//----------------------------------------------
require "../../../../config/classDB.php";
$conn = new Database();
//----------------------------------------------

$query_no_soal = "SELECT MAX(id_soal)+1 as new_id_soal FROM soal_tabel";
$proses_no_soal = $conn->fetch($query_no_soal);
foreach ($proses_no_soal as $key => $result_no) {
	if($result_no['new_id_soal'] == null){
		$no = 1;
	}else{
		$no = $result_no['new_id_soal'];
	}
}

?>
<center><div id="new_no"><?php echo $no; ?></div></center>
<input type="hidden" id="input_new_no" name="input_new_no" value="<?php echo $no; ?>" required>