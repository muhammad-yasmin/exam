<?php
//----------------------------------------------
require "../../config/classDB.php";
$conn = new Database();
//----------------------------------------------

$id = $_POST['idkey'];
$where = array('id_log'=>$id);
$proses = $conn->delete('log_activities', $where);

if($proses){
	echo "disconnect";
}else{
	echo "gagal";
}
?>