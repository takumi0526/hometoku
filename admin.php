<?php

  session_start();
  if($_COOKIE['staff_id'] != ''){
    $staff_id=$_COOKIE['staff_id'];
  }else if ($_SESSION['staff_id'] != ''){
    $staff_id=$_SESSION['staff_id'];
    $_SESSION['staff_id'] = 0;
  }else {
    header('Location: login.php');
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
        <li onClick="location.href='admin.php'" style="background-color:#eee">リスト</li>
        <li onClick="location.href='./test/reset_index.php'">クリア</li>
        <li onClick="location.href='inport.php'">登録</li>
        <li onClick="location.href='delete.php'">削除</li>
        <li onClick="location.href='login.php'">一般ログイン</li>
      </ul>
    </div>

  	<div id="content">

      <?php
        require_once('dbconnect.php');
        $mysqli=db_connect();
        $sql="SELECT staff_id, count_commend, count_praised FROM staff_praised ORDER BY staff_id ASC";
        $result=$mysqli->query($sql);

        echo "<table id='staff_list'>";
        echo "<tr>";
        echo "<th>社員ID</th>";
        echo "<th colspan='2'>氏名</th>";
        //echo "<th>名</th>";
        //echo "<th>名</th>";
        echo "<th>ホメた</th>";
        echo "<th>ホメられた</th>";
        echo "</tr>";

        while($row=$result->fetch_row()){

          $staff_id=$row[0];

          if($staff_id!=0){
            $sql="SELECT family,name FROM staff_table WHERE staff_id=".$staff_id;
            $result2=$mysqli->query($sql);
            while($row2=$result2->fetch_row()){
              $family=$row2[0];
              $name=$row2[1];
            }

            echo "<tr>";
            $count_commend=$row[1];
            $count_praised=$row[2];
            echo "<td class='staff_id'>".$staff_id."</td>";
            //echo "<td class='staff_name'>".$family." ".$name."</td>";
            echo "<td class='staff_family'>".$family."</td>";
            echo "<td class='staff_name'>".$name."</td>";
            echo "<td class='staff_hometa'>".$count_commend."</td>";
            echo "<td class='staff_homerareta'>".$count_praised."</td>";
          }

          echo "</tr>";
        }

        echo "</table>";
      ?>

    </div>

    <!--
    <form>
      <dd>
        <INPUT type="submit" name="submit" value="登録" onClick="form.action='inport.php'"/>
        <INPUT type="submit" name="submit" value="削除" onClick="form.action='delete.php'"/>
      </dd>
      <INPUT type="submit" name="submit" value="クリア" onClick="form.action='clea.php'"/>
      <INPUT type="submit" name="submit" value="リスト" onClick="form.action='list.php'"/>
  	</form>
    -->
	</body>
</html>