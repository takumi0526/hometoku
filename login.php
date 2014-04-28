<?php
	
	require ('dbconnect.php');
	session_start();
	$mysqli=db_connect();
	if (!empty($_COOKIE['staff_id'])) {
		$_POST['staff_id'] = $_COOKIE['staff_id'];
		$_POST['pass'] = $_COOKIE['pass'];
		$_POST['save'] = 'on';
	}
	
	if (!empty($_POST)) {
		if ($_POST['staff_id'] != '' && $_POST['pass'] != '') {
			$staff_id=$_POST['staff_id'];
			$pass=$_POST['pass'];
			$sql ='SELECT * FROM staff_table WHERE staff_id='.$staff_id.' AND pass="'.$pass.'"';
			$result=$mysqli -> query($sql);
			$mysqli->real_escape_string($staff_id);
			#mysqli_real_escape_string($pass);
			$record = $mysqli->query($sql);
			if($record==false){
					$error['login'] = 'failed';
				}else 
					if ($table = $record -> fetch_assoc()) {
				// ログイン成功
				$_SESSION['staff_id'] = $table['staff_id'];
			
				if ($_POST['save'] == 'on' && $staff_id!=0) {
					setcookie('staff_id', $staff_id, time()+60*60*24*14);
					setcookie('pass', $pass, time()+60*60*24*14);
				}
				if ($staff_id == 0) {
					header('Location: admin.php');
					exit();
				}
				header('Location: index.php'); 
				exit();
			} else {
				$error['login'] = 'failed';
			}
		} else {
			$error['login'] = 'blank';
		}
	}
?>


<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />		
		<script type="text/javascript" src="./lib/jquery.min.js"></script>
		<script type="text/javascript" src="./lib/endless_scroll_min.js"></script>
		<script type="text/javascript" src="./lib/Vague.js"></script>
		<script type="text/javascript" src="login.js"></script>
		<link rel="stylesheet" type="text/css" href="login.css">
		<title>ログインする</title>
	</head>
	<body>

  		<div id="background">
  			<img class="background_img" src="./images/background_login.png">
 		</div>

		<div id="wrap">
			<div id="wrap_back">
		  		<div id="head">
		    		<img id="logo" src="./images/logo.png">
		  		</div>

		  		<div id="content">
		  			<form id="login_form" action="" method="post">
		      			<dl>
		        			<dt>ID</dt>
		        			<dd>
		          				<input type="text" name="staff_id" size="25" maxlength="255" value="<?php echo htmlspecialchars($_POST['staff_id']); ?>" />
		          				<?php if ($error['login'] == 'blank'): ?>
		          				<p class="error">* 社員IDとパスワードを入力しろ</p>
		          				<?php endif; ?>
		          				<?php if ($error['login'] == 'failed'): ?>
		          				<p class="error">* ログインに失敗。正しく入力しろ。</p>
		          				<?php endif; ?>
		        			</dd>

		        			<dt>PASS</dt>
		        			<dd>
		          				<input type="password" name="pass" size="25" maxlength="255" value="<?php echo htmlspecialchars($_POST['pass']); ?>" />
		        			</dd>

		        			<!-- <dt>ログイン情報の記録</dt> -->
		        			<dd>
		          				<input id="save" type="checkbox" name="save" value="on">
		          				<label for="save">Remember me</label>
		        			</dd>
		      			</dl>

		      			<div>
		        			<!-- <input type="submit" value="ログイン" /> -->
		        			<button type="submit">
		        				<img src="./images/button_login.png">
		        			</button>
		      			</div>
		    		</form>
		  		</div>
		  	</div>
  		</div>
	</body>
</html>