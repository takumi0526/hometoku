<?php
/*
output sum of each flower
*/
ini_set('display_errors', 1);

require_once("../dbconnect.php");
$mysqli=db_connect();
session_start();
if(!empty($_COOKIE['staff_id'])){
	$staff_id=$_COOKIE['staff_id'];
}else{
	$staff_id=$_SESSION['staff_id'];
}

// for test
//$sql="UPDATE all_accumulation SET flower_A=4, flower_B=8, flower_C=5, flower_D=2, flower_E=6";
//$result=$mysqli->query($sql);

$sql="SELECT flower_A, flower_B, flower_C, flower_D, flower_E FROM all_accumulation";
$result=$mysqli->query($sql);
while($row=$result->fetch_row()){	
	$flower_A_num=$row[0];
	$flower_B_num=$row[1];
	$flower_C_num=$row[2];
	$flower_D_num=$row[3];
	$flower_E_num=$row[4];
}

$flower_num=array(
	'flower_A_num'=> (int)$flower_A_num,
	'flower_B_num'=> (int)$flower_B_num,
	'flower_C_num'=> (int)$flower_C_num,
	'flower_D_num'=> (int)$flower_D_num,
	'flower_E_num'=> (int)$flower_E_num,
);

echo json_encode($flower_num);
?>