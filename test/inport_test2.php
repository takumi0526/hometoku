<?php
  require('dbconnect.php');
  session_start();
  $mysqli=db_connect();

  if (!empty($_POST)) {
    // エラー項目の確認
    if ($_POST['staff_id'] == '') {
     $error['staff_id'] = 'blank';
    }
    if ($_POST['family'] == '') {
      $error['family'] = 'blank';
    }
    if ($_POST['name'] == '') {
      $error['name'] = 'blank';
    }
    if ($_POST['kana_family'] == '') {
      $error['kana_family'] = 'blank';
    }
    if ($_POST['kana_name'] == '') {
      $error['kana_name'] = 'blank';
    }
    if ($_POST['nickname'] == '') {
      $error['nickname'] = 'blank';
    }
    if ($_POST['pass'] == '') {
      $error['pass'] = 'blank';
    }
    // 重複アカウントのチェック
    if (empty($error)) {
      $staff_id=$_POST['staff_id'];
      $sql = "SELECT COUNT(*) AS cnt FROM staff_table WHERE staff_id=$staff_id";
      $record = $mysqli->query($sql) or die($mysqli->error());
      $table = $record->fetch_assoc();
      if ($table['cnt'] > 0) {
       $error['staff_id'] = 'duplicate';
      }
    }
    $_SESSION['staff_id'] = $_POST['staff_id'];
    $_SESSION['family']=$_POST['family'];
    $_SESSION['name']=$_POST['name'];
    $_SESSION['kana_family']=$_POST['kana_family'];
    $_SESSION['kana_name']=$_POST['kana_name'];
    $_SESSION['nickname']=$_POST['nickname'];
    $_SESSION['pass']=$_POST['pass'];
    echo $_SESSION['staff_id'];
    header('Location: check.php'); 
    exit();
  }

  // 書き直し
  if ($_REQUEST['action'] == 'rewrite') {
    $_POST['staff_id']=$_SESSION['staff_id'];
    $_POST['family']=$_SESSION['family'];
    $_POST['name']=$_SESSION['name'];
    $_POST['kana_family']=$_SESSION['kana_family'];
    $_POST['kana_name']=$_SESSION['kana_name'];
    $_POST['nickname']=$_SESSION['nickname'];
    $_POST['pass']=$_SESSION['pass'];
    $error['rewite'] = true;
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
        <h1>社員登録</h1>
      </div>
      -->
      <div id="content">
        <p id="honbun">以下のフォームに必要事項をご記入ください。</p>

        <form action="" method="post" enctype="multipart/form-data">

          <dl id="form_area">
            <dt>
              <span class="required">【必須】</span>社員ID
            </dt>
            <dd>
              <input type="text" name="staff_id" size="35" maxlength="255" value="<?php echo htmlspecialchars($_POST['staff_id'], ENT_QUOTES, 'UTF-8'); ?>" />
              <?php if ($error['staff_id'] == 'blank'): ?>
              <p class="error">* 社員IDを入力してください</p>
              <?php endif; ?>
              <?php if ($error['staff_id'] == 'duplicate'): ?>
              <p class="error">* 指定された社員IDはすでに登録されています</p>
              <?php endif; ?>
            </dd>

            <dt>
              <span class="required">【必須】</span>姓
            </dt>
            <dd>
              <input type="text" name="family" size="35" maxlength="255" value="<?php echo htmlspecialchars($_POST['family'], ENT_QUOTES, 'UTF-8'); ?>" />
              <?php if ($error['family'] == 'blank'): ?>
              <p class="error">* 姓を入力してください</p>
              <?php endif; ?>
            </dd>

            <dt>
              <span class="required">【必須】</span>名
            </dt>
            <dd>
              <input type="text" name="name" size="35" maxlength="255" value="<?php echo htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8'); ?>" />
              <?php if ($error['name'] == 'blank'): ?>
              <p class="error">* 名を入力してください</p>
              <?php endif; ?>
            </dd>

            <dt>
              <span class="required">【必須】</span>せい
            </dt>
            <dd>
              <input type="text" name="kana_family" size="35" maxlength="255" value="<?php echo htmlspecialchars($_POST['kana_family'], ENT_QUOTES, 'UTF-8'); ?>" />
              <?php if ($error['kana_family'] == 'blank'): ?>
              <p class="error">* みよじを入力してください</p>
              <?php endif; ?>
            </dd>

            <dt>
              <span class="required">【必須】</span>めい
            </dt>
            <dd>
              <input type="text" name="kana_name" size="35" maxlength="255" value="<?php echo htmlspecialchars($_POST['kana_name'], ENT_QUOTES, 'UTF-8'); ?>" />
              <?php if ($error['kana_name'] == 'blank'): ?>
              <p class="error">* なまえを入力してください</p>
              <?php endif; ?>
            </dd>

            <dt>
              <span class="required">【必須】</span>ニックネーム
            </dt>
            <dd>
              <input type="text" name="nickname" size="35" maxlength="255" value="<?php echo htmlspecialchars($_POST['nickname'], ENT_QUOTES, 'UTF-8'); ?>" />
              <?php if ($error['nickname'] == 'blank'): ?>
              <p class="error">* ニックネームを入力してください</p>
              <?php endif; ?>
            </dd>

            <dt>
              <span class="required">【必須】</span>パスワード
            </dt>
            <dd>
              <input type="password" name="pass" size="35" maxlength="20" value="<?php echo htmlspecialchars($_POST['pass'], ENT_QUOTES, 'UTF-8'); ?>" />
              <?php if ($error['pass'] == 'blank'): ?>
              <p class="error">* パスワードを入力してください</p>
              <?php endif; ?>
            </dd>
          </dl>

          <div>
            <input type="submit" value="入力内容を確認する" />
          </div>

        </form>
      </div>
    </div>

  </body>
</html>
