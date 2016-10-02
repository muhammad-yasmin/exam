<?php
//----------------------------------------------
require "../../../../config/classDB.php";
$conn = new Database();
//----------------------------------------------

$pass_lama_db = $_SESSION['password_nya'];
$input_pass_lama = md5("pass".$_POST['input_pass']."word");

if($input_pass_lama == $pass_lama_db){
	echo "sama";
}else{
	echo "tidak";
}

?>