<?php
/*
AM5:00にフラワーステータスを計算し、昨日誉められた数を消去するプログラム
*/
require_once("/var/www/html/hometoku/dbconnect.php");
$mysqli=db_connect();
$sql="SELECT staff_id,count_praised,count_commend FROM yesterday";

$result=$mysqli->query($sql);
while($row=$result->fetch_row()){
	
	$staff_id=$row[0];

	if($staff_id!=0){
		$count_praised=$row[1];
		$count_commend=$row[2];

		$sql="UPDATE staff_praised SET count_praised=count_praised+?,count_commend=count_commend+? WHERE staff_id=?";
		$sth=$mysqli->stmt_init();
			if($sth->prepare($sql)){
			$sth->bind_param("iii",$count_praised,$count_commend,$staff_id);
			$sth->execute();
		}



		$sql="SELECT flower_status FROM staff_table WHERE staff_id=".$staff_id;
		$result2=$mysqli->query($sql);
		while($row2=$result2->fetch_row()){
			$flower_status=$row2[0];
		}
		if($count_commend==0){
			$magnification=1;
		}else{
			$magnification=1.5;
		}
		//花のステータス=花のステータス*倍率+前日に誉められた数	
		if($count_praised!=0){
			$flower_status=$flower_status*$magnification+$count_praised;
		}else{
			$flower_status++;
		}

		$sql="UPDATE staff_table SET flower_status=?,weather=? WHERE staff_id=?";
		$sth=$mysqli->stmt_init();
		if($sth->prepare($sql)){
				$sth->bind_param("dii",$flower_status,$magnification,$staff_id);
				$sth->execute();
		}

		$sql="UPDATE yesterday SET count_praised='0' ,count_commend='0' WHERE staff_id=?";
		$sth=$mysqli->stmt_init();
		if($sth->prepare($sql)){
			$sth->bind_param("i",$staff_id);
			$sth->execute();
		}

		
	}

}
echo "doned";