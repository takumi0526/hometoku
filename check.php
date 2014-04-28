<?php

	session_start();
	require('dbconnect.php');
	$mysqli=db_connect();
		$staff_id=$_SESSION['staff_id'];
		$family=$_SESSION['family'];
		$name=$_SESSION['name'];
		$kana_family=$_SESSION['kana_family'];
		$kana_name=$_SESSION['kana_name'];
		$nickname=$_SESSION['nickname'];
		$pass=$_SESSION['pass'];
		$time_stamp=time();

	if (!isset($_SESSION['staff_id'])) {
		header('Location: inport.php');
		exit();
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
	        <li onClick="location.href='inport.php'" style="background-color:#eee">登録</li>
	        <li onClick="location.href='delete.php'">削除</li>
        	<li onClick="location.href='login.php'">一般ログイン</li>
	      </ul>
	    </div>

		<div id="wrap">
			<!--
			<div id="head">
				<h1>会員登録</h1>
			</div>
			-->
			<div id="content">
				<p id="honbun">記入した内容を確認して、「登録する」ボタンをクリックしてください。</p>

				<form action="in.php" method="post">
					<input type="hidden" name="action" value="submit" />

					<dl id="confirm_area">
						<dt>社員ID</dt>
						<dd>
							<?php echo $staff_id; ?>
        				</dd>

        				<dt>姓</dt>
						<dd>
							<?php echo htmlspecialchars($family, ENT_QUOTES, 'UTF-8'); ?>
        				</dd>

        				<dt>名</dt>
						<dd>
							<?php echo htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?>
        				</dd>

        				<dt>みよじ</dt>
						<dd>
							<?php echo htmlspecialchars($kana_family, ENT_QUOTES, 'UTF-8'); ?>
        				</dd>

        				<dt>なまえ</dt>
						<dd>
							<?php echo htmlspecialchars($kana_name, ENT_QUOTES, 'UTF-8'); ?>
        				</dd>

        				<dt>ニックネーム</dt>
						<dd>
							<?php echo htmlspecialchars($nickname, ENT_QUOTES, 'UTF-8'); ?>
        				</dd>
					</dl>

					<div>
						<a href="inport.php?action=rewrite">&laquo;&nbsp;書き直す</a> | <input type="submit" value="　登録する　" />
					</div>
				</form>

			</div>
		</div>
	</body>
</html>
