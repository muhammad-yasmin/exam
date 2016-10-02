<?php
date_default_timezone_set('Asia/Jakarta');
if(!isset($_SESSION)){ session_start(); }
include_once "dbconfig.php";

class Database
{
	public function __construct()
	{
		$db = new DB_con();
	}

	public function custom($sql)
	{
		$result=mysql_query($sql);
		return $result;
	}

	public function fetch($sql)
	{
		$result=mysql_query($sql);
		$arr_result = [];
		while ($data = mysql_fetch_assoc($result)) {
			array_push($arr_result, $data);
		}
		return $arr_result;
	}

	public function insert($tblName, array $val_cols)
	{
		$keysString = implode(", ", array_keys($val_cols));

		$i=0;
		foreach ($val_cols as $key => $value) {
			$StValue[$i] = "'".$value."'";
			$i++;
		}

		$StValues = implode(", ",$StValue);

		$sql = "INSERT INTO $tblName ($keysString) VALUES ($StValues)";
		$result = mysql_query($sql);
		return $result;
	}

	public function delete($tblName, array $val_where)
	{
		$i=0;
		foreach ($val_where as $key => $value) {
			$where[$i] = $key." = '".$value."'";
			$i++;
		}

		$StWhere = implode(" AND ",$where);

		$sql = "DELETE FROM $tblName WHERE $StWhere";
		$result = mysql_query($sql);
		return $result;
	}

	public function update($tblName, array $val_cols, array $val_where)
	{
		$i=0;
		foreach ($val_cols as $key => $value) {
			$set[$i] = $key." = '".$value."'";
			$i++;
		}
		$StValue = implode(", ",$set);

		if($val_where == null){
			$st = "where gak ada";
			$sql = "UPDATE $tblName SET $StValue";
		}else{
			$st = "where ada";
			$i=0;
			foreach ($val_where as $key => $value) {
				$where[$i] = $key." = '".$value."'";
				$i++;
			}
			$StWhere = implode(" AND ",$where);

			$sql = "UPDATE $tblName SET $StValue WHERE $StWhere";
		}
		
		$result = mysql_query($sql);
		return $result;
	}

}
?>