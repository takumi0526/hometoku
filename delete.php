<?php

	session_start();
	if ($_POST['staff_id'] != '') {
		$_SESSION['staff_id']=$_POST['staff_id'];
		if (!isset($_SESSION['staff_id'])) {
			header('Location: delete.php');
		}
		else{
			header('Location: del_chk.php');
		}
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
        <p id="honbun">削除する社員のIDをご入力ください。</p>

  			<form action="" method="post">
      		<dl id="delete_area">
      			<dt>社員ID</dt>
      			<dd>
        				<input type="text" name="staff_id" size="35" maxlength="255" value="<?php echo htmlspecialchars($_POST['staff_id']); ?>" />
        				<?php if ($error['login'] == 'blank'): ?>
          			<p class="error">* 社員IDを入力しろ</p>
          			<?php endif; ?>
          			<?php if ($error['login'] == 'failed'): ?>
        				<p class="error">* 検索に失敗。正しく入力しろ。</p>
        				<?php endif; ?>
      			</dd>
          </dl>

      		<div>
        		<input type="submit" value="　検索　" />
      		</div>
    		</form>

      </div>
 		</div>
	</body>
</html>