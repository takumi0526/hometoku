<?php
	
	require ('dbconnect.php');

	session_start();
	$mysqli=db_connect();
	$staff_id=$_SESSION['staff_id'];
	$family=$_SESSION['family'];
	$name=$_SESSION['name'];
	$kana_family=$_SESSION['kana_family'];
	$kana_name=$_SESSION['kana_name'];
	$nickname=$_SESSION['nickname'];
	$pass=$_SESSION['pass'];
	//$time_stamp=time();
	$sql="INSERT INTO staff_table (staff_id, pass, kana_family, kana_name, family, name, nickname,time_stamp)
	VALUES (?,?,?,?,?,?,?,NOW())";
	//($staff_id,$pass,$kana_family,kana_name,$family,$name,$nickname,1,0,0,0,1,0,NOW() )";
	
//	$result=$mysqli->query($sql);
	//$mysql->query($sql) or die($mysqli->error());
	//unset($_SESSION['staff_id'],$_SESSION['family'],$_SESSION['name'],$_SESSION['kana_family'],$_SESSION['kana_name'],$_SESSION['nickname'],$_SESSION['pass']);
	$sth=$mysqli->stmt_init();
		if($sth->prepare($sql)){
				$sth->bind_param("issssss",$staff_id,$pass,$kana_family,$kana_name,$family,$name,$nickname);
				$sth->execute();
		}
	$sql="INSERT INTO staff_praised(staff_id) VALUES (".$staff_id.")";
	$mysqli->query($sql);
	$sql="INSERT INTO yesterday(staff_id) VALUES (".$staff_id.")";
	$mysqli->query($sql);

?>


<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />		
		<title></title>
	</head>
	<body>
		<div id="wrap">
  		<div id="head">
    		<h1>登録しました</h1>
  		</div>
  		<div id="content">
        <form>
          <INPUT type="submit" name="submit" value="管理画面へ" onClick="form.action='admin.php'"/> 
          <INPUT type="submit" name="submit" value="ログイン画面へ" onClick="form.action='login.php'"/>
  		  </form>
  		</div>
  	</div>
	</body>
</html>