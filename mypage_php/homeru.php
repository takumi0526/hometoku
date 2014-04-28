<?php
ini_set('display_errors', 1);
$other_id=$_POST['staff_id'];

require_once("../dbconnect.php");
$mysqli=db_connect();
session_start();
if(!empty($_COOKIE['staff_id'])){
	$staff_id=$_COOKIE['staff_id'];
}
else{
	$staff_id=$_SESSION['staff_id'];
}

// for test
//$sql="UPDATE staff_table SET drop_data=5 WHERE staff_id=$staff_id";
//$result=$mysqli->query($sql);

$sql="SELECT drop_data FROM staff_table WHERE staff_id=$staff_id";
$result=$mysqli->query($sql);
while($row=$result->fetch_row()){
	$drop=$row[0];
}

if ($drop >= 1){
	$drop_data=$drop-1;
	$count_commend=1;
	$sql="SELECT count_praised FROM yesterday WHERE staff_id=$other_id";
	$result=$mysqli->query($sql);
	while($row=$result->fetch_row()){
		$count=$row[0];
		$count_praised=$count+1;
	}

	$sql="UPDATE staff_table SET drop_data=$drop_data WHERE staff_id=$staff_id";
	$result=$mysqli->query($sql);
	$sql="UPDATE yesterday SET count_commend=$count_commend WHERE staff_id=$staff_id";
	$result=$mysqli->query($sql);
	$sql="UPDATE yesterday SET count_praised=$count_praised WHERE staff_id=$other_id";
	$result=$mysqli->query($sql);

	echo $count_praised;
}
else{
	echo 0;
}

?>