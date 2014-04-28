<?php
/*
DBの社員番号以外の内部データを消去する(0埋めする)
*/

require_once("/var/www/html/hometoku/dbconnect.php");
$mysqli=db_connect();
$sql="SELECT staff_id FROM staff_table";
$result=$mysqli->query($sql);
while($row=$result->fetch_row()){	
	$staff_id=$row[0];
	echo "staff_id:".$staff_id;
	if($staff_id!=0){
		$sql2="UPDATE staff_table SET drop_data=0 ,weather=0,accumulation=0,praised=0,seed_id=0,flower_status=0 WHERE staff_id=?";
		$sth=$mysqli->stmt_init();
		if($sth->prepare($sql2)){
			$sth->bind_param("i",$staff_id);
			$sth->execute();
		}
		$sql3="UPDATE yesterday SET count_praised=0 ,flag_praise=0 WHERE staff_id=?";
		$sth=$mysqli->stmt_init();
		if($sth->prepare($sql3)){
			$sth->bind_param("i",$staff_id);
			$sth->execute();
		}
		$sql4="UPDATE all_accumulation SET all_accumulation=0 ,flower_A=0,flower_B=0,flower_C=0,flower_D=0,flower_E=0";
		$mysqli->query($sql4);
	}
}
echo "done";