<?php
require_once("../dbconnect.php");
$mysqli=db_connect();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $staff_id = htmlspecialchars($_POST["staff_id"], ENT_QUOTES);
    $drop_data = $_POST["drop_data"];
    $weather = $_POST["weather"];
    $seed_id = $_POST["seed_id"];
    $flower_status=$_POST["flower_status"];
    
    if(empty($staff_id) || empty($flower_status)){
      echo "<h1>再入力してください 3秒後に戻ります。</h1>";
    //  header("location:test2.php");
     echo '<meta http-equiv="Refresh" content="3, index.php">';
    }
} else {
    echo "フォームページからアクセスしてください。";
    exit(1);
}
$sql="UPDATE staff_table SET drop_data=?,weather=?,seed_id=?,flower_status=? WHERE staff_id=?";
$sth=$mysqli->stmt_init();
if($sth->prepare($sql)){
  $sth->bind_param("iiiii",$drop_data,$weather,$seed_id,$flower_status,$staff_id);
  $sth->execute();
 
}

echo "実行しました";