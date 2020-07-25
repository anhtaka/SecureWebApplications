<?php
require_once './common.php';
require_loggedin();

$item       = filter_input(INPUT_POST, "item");
$todo       = filter_input(INPUT_POST, "todo");
$c_date     = filter_input(INPUT_POST, "c_date");
$due_date   = filter_input(INPUT_POST, "due_date");
$done       = filter_input(INPUT_POST, "done") ? 1 : 0;
$public     = filter_input(INPUT_POST, "public") ? 1 : 0;
$token      = filter_input(INPUT_POST, TOKENNAME);
$attachment = @$_FILES["attachment"];

// CSRF対策
if (@$_SESSION[TOKENNAME] != $token) {
  die('正規の画面からアクセスしてください');
}

$id = $user->get_id();

$name = null;
if (empty($todo)) {
  die('todoが空です');
}
if ($attachment['error'] === 0) {
  $tmp_name = $attachment["tmp_name"];
  $name = $attachment["name"];
  $realname = uniqid() . '-' . $name;
  move_uploaded_file($tmp_name, "attachment/$name");
}

try {
  $dbh = dblogin();

  if (empty($name)){ 
    $sql = 'UPDATE todos SET todo=?, c_date=?, due_date=?, done=?, public=? WHERE id=?';
    $values = array($todo, $c_date, $due_date, $done, $public, $item);
  } else {
    $sql = 'UPDATE todos SET todo=?, c_date=?, due_date=?, done=?, org_filename=?, real_filename=?, public=? WHERE id=?';
    $values = array($todo, $c_date, $due_date, $done, $name, $realname, $public, $item);
  }
  $sth = $dbh->prepare($sql);
  $rs = $sth->execute($values);
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
    変更しました
  </div><!-- /#done -->
<?php require "footer.php"; ?>
</div>
</body>
</html>
