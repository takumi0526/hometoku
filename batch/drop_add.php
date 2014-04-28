<?php
/*
AM5:00に動くcronでdropdateを1つ増やすプログラム
dropdateが5より多い場合は増やさない。
*/
require_once("/var/www/html/hometoku/dbconnect.php");
$mysqli=db_connect();
$sql="SELECT staff_id,drop_data FROM staff_table";
$result=$mysqli->query($sql);
while($row=$result->fetch_row()){
	$staff_id=$row[0];
	if($staff_id!=0){
	$drop_data=$row[1];
		if($drop_data!=5){
			$drop_data++;
			$sth=$mysqli->stmt_init();
			$sql="UPDATE staff_table SET drop_data=? where staff_id=?";
			if($sth->prepare($sql)){
				$sth->bind_param("ii",$drop_data,$staff_id);
				$sth->execute();
			}
		}
	}
}