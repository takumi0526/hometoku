<?php
/*
γEΉγη¨γ«γEEγΏγγ©γ³γγ γ§γ’γEEγEEγγγγEγ­γ°γ©γ 
ζ©θEθͺγγγγζ°γ¨γγ©γ°γθΏ½ε γγ
*/
require_once("../dbconnect.php");
$mysqli=db_connect();
$sql="SELECT staff_id,count_praised,count_commend FROM yesterday";
$result=$mysqli->query($sql);
while($row=$result->fetch_row()){	
	$staff_id=$row[0];
	echo "staff_id:".$staff_id;
	if($staff_id!=0){
		$sql2="UPDATE yesterday SET count_praised=? ,count_commend=? WHERE staff_id=?";
		$sth=$mysqli->stmt_init();
		$count_praised=mt_rand(0,10);
		$flag_praise=mt_rand(0,10);
		if($sth->prepare($sql2)){
			$sth->bind_param("iii",$count_praised,$flag_praise,$staff_id);
			$sth->execute();
		}
	}
}
echo "doned";