<?php

	session_start();
	if($_COOKIE['staff_id'] != ''){
		$staff_id=$_COOKIE['staff_id'];
	}else if ($_SESSION['staff_id'] != ''){
		$staff_id=$_SESSION['staff_id'];
		$_SESSION['staff_id'] = $staff_id;
	}else {
		header('Location: login.php');
	}


?>

<html>
	<head>
		<title>MyPage</title>
		<script type="text/javascript" src="./lib/jquery.min.js"></script>
		<script type="text/javascript" src="./lib/jquery.corner.js"></script>
		<script type="text/javascript" src="./lib/jbubbles.js"></script>
		<script type="text/javascript" src="./lib/jqfloat.min.js"></script>
		<script type="text/javascript" src="mypage.js"></script>
		<link rel="stylesheet" type="text/css" href="mypage.css">
	</head>

	<body>
		<div id="parameter">
			<ul id="water_list">
				<li><img id="go_all" src="./images/garden_button.png"></li>
			</ul>
		</div>

		<div id="flower_area"></div>

		<ul id="shain_list">
		 	<input type="text" name="input_name" id="name_search">
			<div id="names"></div>
		</ul>

		<div id="gray_panel"></div>
		<div id="blossom_popup">
			<div id="message_area">
				<img class="blossom_message" src="./images/message_pop-up.png">
			</div>
		</div>
	</body>
</html>
