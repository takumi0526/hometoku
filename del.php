<?php

	require ('dbconnect.php');
	session_start();
	$mysqli=db_connect();

	$staff_id=$_SESSION['staff_id'];


	$sql="DELETE FROM staff_table WHERE staff_id=$staff_id";
	$result=$mysqli->query($sql);
	$sql="DELETE FROM yesterday WHERE staff_id=$staff_id";
	$result=$mysqli->query($sql);
	$sql="DELETE FROM staff_praised WHERE staff_id=$staff_id";
	$result=$mysqli->query($sql);

?>


<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    	<link rel="stylesheet" type="text/css" href="admin.css">
		<title>管理ツール</title>
	</head>
	<body>

	    <p id="top_bar">管理ツール</p>

	    <div id="menu">
	      <ul>
	        <li onClick="location.href='admin.php'">リスト</li>
	        <li onClick="location.href='clea.php'">クリア</li>
	        <li onClick="location.href='inport.php'">登録</li>
	        <li onClick="location.href='delete.php'" style="background-color:#eee">削除</li>
	        <li onClick="location.href='login.php'">一般ログイン</li>
	      </ul>
	    </div>

		<div id="wrap">
			<!--
	  		<div id="head">
	    		<h1>削除しました</h1>
	  		</div>
	  		-->
	  		<div id="content">
    		    <p id="honbun">削除しました。</p>

				<!--
		        <form>
		        	<INPUT type="submit" name="submit" value="管理画面へ" onClick="form.action='admin.php'"/>
		        	<INPUT type="submit" name="submit" value="ログイン画面へ" onClick="form.action='login.php'"/>
		  		</form>
	  			-->
	  		</div>
  		</div>

	</body>
</html>