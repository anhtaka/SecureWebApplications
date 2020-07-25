<?php
require_once './common.php';
require_loggedin();

$item  = filter_input(INPUT_POST, "item");
$token = filter_input(INPUT_POST, TOKENNAME);

// CSRF対策

$id = $user->get_id();

try {
  $dbh = dblogin();
  $sql = 'SELECT real_filename FROM todos WHERE id=?';
  $sth = $dbh->prepare($sql);
  $rs = $sth->execute(array($item));
  $result = $sth->fetch();
  $file = $result['real_filename'];
  unlink("attachment/$file");

  $sql = 'UPDATE todos SET org_filename=NULL, real_filename=NULL WHERE id=?';
  $sth = $dbh->prepare($sql);
  $rs = $sth->execute(array($item));
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
    添付フィルを削除しました
  </div><!-- /#done -->
<?php require "footer.php"; ?>
</div>
</body>
</html>
