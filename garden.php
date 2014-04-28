<?php

session_start();
if($_COOKIE['staff_id'] != NULL){
	$staff_id=$_COOKIE['staff_id'];
}else if ($_SESSION['staff_id'] != NULL){
	$staff_id=$_SESSION['staff_id'];
}else {
	header('Location: login.php');
}

?>

<html>
	<head>
		<title>Garden</title>
		<script type="text/javascript" src="./lib/jquery.min.js"></script>
		<script type="text/javascript" src="garden.js"></script>
		<link rel="stylesheet" type="text/css" href="garden.css">
	</head>

	<body>
		<img id="go_home" src="./images/home_button.png">
	</body>
</html>
