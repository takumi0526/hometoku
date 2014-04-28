<?php
	require ('dbconnect.php');
	session_start();
	$mysqli=db_connect();

	$staff_id=$_SESSION['staff_id'];
	$sql ="SELECT family,name,kana_family,kana_name FROM staff_table WHERE staff_id=$staff_id";
	$result=$mysqli -> query($sql);
	while($row=$result->fetch_row()){
		$family=$row[0];
		$name=$row[1];
		$kana_family=$row[2];
		$kana_name=$row[3];
		//echo $family;
		//echo $name;
		//echo $kana_family;
		//echo $kana_name;
	}
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
	    		<h1>削除</h1>
	  		</div>
	  		-->
	  		<div id="content">
    		    <p id="honbun">よろしければ削除ボタンを押してください。</p>

	  			<form action="del.php" method="post">
	      			<dl id="confirm_area">
	        			<dt>社員ID</dt>
	        			<dd>
	          				<?php echo $staff_id; ?>
	        			</dd>

	        			<dt>名前</dt>
	        			<dd>
	        				<?php echo $family; echo $name; ?>
	        			</dd>

	        			<dt>なまえ</dt>
	        			<dd>
	        				<?php echo $kana_family; echo $kana_name; ?>
	        			</dd>
	        		</dl>

	      			<div>
	        			<input type="submit" value="　削除　" />
	      			</div>
	    		</form>
	 		</div>

	 	</div>
	</body>
</html>