<?php

	session_start();
	require('dbconnect.php');
	$mysqli=db_connect();
		$staff_id=$_SESSION['staff_id'];
		$drop_date=$_SESSION['drop_date'];
		$wather=$_SESSION['wather'];
		$seed_id=$_SESSION['seed_id'];
		$flower_status=$_SESSION['flower_status'];
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
		<title>テストツール</title>
	</head>

	<body>

	    <p id="top_bar">テストツール</p>    
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

        				<dt>ほめられる回数(5まで)</dt>
						<dd>
							<?php echo htmlspecialchars($drop_date, ENT_QUOTES, 'UTF-8'); ?>
        				</dd>

        				<dt>天気</dt>
						<dd>
							<?php echo htmlspecialchars($wather, ENT_QUOTES, 'UTF-8'); ?>
        				</dd>

        				<dt>種ID(0-4)</dt>
						<dd>
							<?php echo htmlspecialchars($seed_id, ENT_QUOTES, 'UTF-8'); ?>
        				</dd>

        				<dt>flower_status:花の状態</dt>
						<dd>
							<?php echo htmlspecialchars($flower_status, ENT_QUOTES, 'UTF-8'); ?>
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
