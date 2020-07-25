<?php
require_once './common.php';
require_loggedin();

$reqid = filter_input(INPUT_POST, "id");
$pwd   = substr(filter_input(INPUT_POST, "pwd"), 0, 6);
$token = filter_input(INPUT_POST, TOKENNAME);
$id = $user->get_id();
if ($id !== $reqid && ! $user->is_super()) {
  die('ログインしていないか権限がありません');
}
// CSRF対策


try {
  $dbh = dblogin();
  $sql = 'SELECT pwd FROM users WHERE id=?';
  $sth = $dbh->prepare($sql);
  $rs = $sth->execute(array($id));
  $row = $sth->fetch(PDO::FETCH_ASSOC);
  if ($pwd !== $row['pwd']) {
    die('パスワードが違います');
  }
  $sql = 'DELETE FROM users WHERE id=?';
  $sth = $dbh->prepare($sql);
  $rs = $sth->execute(array($reqid));
  session_destroy();
  $_SESSION = array();
} catch (PDOException $e) {
  $logger->add('クエリに失敗しました: ' . $e->getMessage());
  die('只今サイトが大変混雑しています。もうしばらく経ってからアクセスしてください');
}
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/common.css">
<title>Todo変更</title>
</head>
<body>
<div id="top">
<?php require "menu.php"; ?>
  <div id="done">
    退会しました
  </div><!-- /#done -->
<?php require "footer.php"; ?>
</div>
</body>
</html>
