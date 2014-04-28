<?php
//ini_set('display_errors', 1);
$name_key = $_POST['name_key'];
require ('../dbconnect.php');
$mysqli=db_connect();
session_start();

if(!empty($_COOKIE['staff_id'])){
	$staff_id=$_COOKIE['staff_id'];
}else{
	$staff_id=$_SESSION['staff_id'];
}

if($name_key) {
$sql = 'SELECT family,name,kana_family,kana_name,staff_id FROM staff_table WHERE NOT staff_id=';
	$sql.=$staff_id;
	$sql.=' AND ( family LIKE "%';
	$sql.=$name_key;
	$sql.='%" OR name LIKE "%';
	$sql.=$name_key;
	$sql.='%" OR kana_family LIKE "%';
	$sql.=$name_key;
	$sql.='%" OR kana_name LIKE "%';
	$sql.=$name_key;
	$sql.='%")';
	}
else {
	$sql = "SELECT family,name,kana_family,kana_name,staff_id FROM staff_table WHERE NOT family = 'admin' AND NOT staff_id=".$staff_id." ORDER BY kana_family ASC";
}

$result = $mysqli->query($sql);
$i=0;
while($data = $result->fetch_row()) {
	$result_json[] = array(
		'family' => $data[0],
		'name' => $data[1],
		'kana_family' => $data[2],
		'kana_name' => $data[3],
		'staff_id' => $data[4],
	);
	$i++;
}
//header('Content-type: application/json; charaset=utf-8')
echo json_encode($result_json);
?>