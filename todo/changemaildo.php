<?php
  require_once('./common.php');
  require_loggedin();
  $id = $user->get_id();
  $email = filter_input(INPUT_POST, 'email');
  $reqid = filter_input(INPUT_POST, 'id');
  if (empty($reqid))
    $reqid = $id;

  try {
    $dbh = dblogin();
  
    $sql = 'UPDATE users SET email=? WHERE id=?';
    $sth = $dbh->prepare($sql);
    $rs = $sth->execute(array($email, $reqid));
  } catch (PDOException $e) {
    $logger->add('クエリに失敗しました: ' . $e->getMessage());
    die('只今サイトが大変混雑しています。もうしばらく経ってからアクセスしてください');
  }
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/common.css">
<title>メールアドレス変更</title>
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
