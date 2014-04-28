<?php
/*
choose seed randomly
output seed and status of flower
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


$sql="SELECT flower_status,seed_id,drop_data,weather FROM staff_table WHERE staff_id=".$staff_id;
$result=$mysqli->query($sql);
while($row=$result->fetch_row()){	
	$flower_status=$row[0];
	$seed_id=$row[1];
	$drop_data=$row[2];
	$weather=$row[3];
}

$personalized_accumulation=0;
$seed_id_array=array();
$seed_id_array[]=(int)$seed_id;
$flower_flag=0;

while($flower_status>=15){
	$flower_flag=1;
	$flower_status=$flower_status-15;
	switch($seed_id){
		case 0:
		$sql="UPDATE all_accumulation SET all_accumulation=all_accumulation+1,flower_a=flower_a+1";
		break;
		case 1:
		$sql="UPDATE all_accumulation SET all_accumulation=all_accumulation+1,flower_b=flower_b+1";
		break;
		case 2:
		$sql="UPDATE all_accumulation SET all_accumulation=all_accumulation+1,flower_c=flower_c+1";
		break;
		case 3:
		$sql="UPDATE all_accumulation SET all_accumulation=all_accumulation+1,flower_d=flower_d+1";
		break;
		case 4:
		$sql="UPDATE all_accumulation SET all_accumulation=all_accumulation+1,flower_e=flower_e+1";
		break;
	}
	$result=$mysqli->query($sql);
	$seed_id=mt_rand(0,4);
	$seed_id_array[]=(int)$seed_id;
	$personalized_accumulation++;
}

$sql="UPDATE staff_table SET accumulation=accumulation+?,flower_status=?,seed_id=? where staff_id=?";
$sth=$mysqli->stmt_init();
if($sth->prepare($sql)){
	$sth->bind_param("iiii",$personalized_accumulation,$flower_status,$seed_id,$staff_id);
	$sth->execute();
	//echo "personalized:".$personalized_accumulation."<br>";
	//echo "flower_status:".$flower_status."<br>";
	//echo "seed:".$seed_id."<br>";
	//echo "staff_id:".$staff_id."<br>";
}

$arr=array(
	'drop_data'=> (int)$drop_data,
	'flower_flag'=> (int)$flower_flag,
	'seed_id'=>$seed_id_array,
	'flower_status'=> (int)$flower_status,
	'weather'=>(int)$weather,
);
echo json_encode($arr);

?>
