<?php
//----------------------------------------------
require "../../../../config/classDB.php";
$conn = new Database();
//----------------------------------------------

$id = $_POST['idkey'];
$lv = $_POST['level'];
if($id == 'all'){
	$sql = "DELETE FROM log_activities WHERE level='$lv'";
	$proses = $conn->custom($sql);
}else{
	$where = array('id_log'=>$id);
	$proses = $conn->delete('log_activities', $where);
}

if($proses){
	echo "disconnect";
}else{
	echo "gagal";
}
?>