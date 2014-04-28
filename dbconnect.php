<?php
function db_connect(){
	$host="localhost";
	$user="root";
	$password="rootrootroot";
	$database="hometoku";

	$mysqli=new mysqli($host,$user,$password,$database);

	if($mysqli->connect_errno){
		die('Connect Error'.$mysqli->connect_errno);
	}
	return $mysqli;
}
