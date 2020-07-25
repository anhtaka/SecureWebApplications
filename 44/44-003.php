<?php
  session_start();
  header('Content-Type: text/html; charset=UTF-8');
  $id = @$_POST['ID'];   // ユーザID
  $pwd = @$_POST['PWD']; // パスワード
  // データベースに接続
  $db = new PDO("mysql:host=127.0.0.1;dbname=wasbook", "wasbook", "wasbook");
  // SQLの組み立て
  $sql = "SELECT * FROM users WHERE id ='$id' AND PWD = '$pwd'";
  $ps = $db->query($sql);   // クエリー実行
?>
<html>
<body>
<?php
  if ($ps->rowCount() > 0) { // SELECTした行が存在する場合ログイン成功
    $_SESSION['id'] = $id;
    echo 'ログイン成功です';
  } else {
    echo 'ログイン失敗です';
  }
  // pg_close($con);
?>
</body>
</html>
