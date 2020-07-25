<?php
  require_once('./common.php');
  require_loggedin();
  $token = filter_input(INPUT_POST, TOKENNAME);
  require_token($token);
  $id = $user->get_id();
  $pwd   = filter_input(INPUT_POST, 'newpwd');
  $pwd2  = filter_input(INPUT_POST, 'newpwd2');
  $reqid = filter_input(INPUT_POST, 'id');
  if ($pwd !== $pwd2) {
    die('パスワードが一致していません');
  }
  if (! $user->is_super() && $id !== $reqid) {
    die('権限がありません');
  }
  try {
    $dbh = dblogin();
  
    $sql = 'UPDATE users SET pwd=? WHERE id=?';
    $sth = $dbh->prepare($sql);
    $rs = $sth->execute(array($pwd, $reqid));
  } catch (PDOException $e) {
    $logger->add('クエリに失敗しました: ' . $e->getMessage());
    die('只今サイトが大変混雑しています。もうしばらく経ってからアクセスしてください');
  }
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/common.css">
<title>パスワード変更</title>
</head>
<body>
<div id="top">
<?php require "menu.php"; ?>
  <div id="done">
    変更しました。<BR><BR>
  </div><!-- /#done -->
<?php require "footer.php"; ?>
</div>
</body>
</html>
