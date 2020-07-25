<?php
  require_once('./common.php');
  $email = filter_input(INPUT_POST, 'email');
  $token = filter_input(INPUT_POST, TOKENNAME);
  require_token($token);

  try {
    $dbh = dblogin();
    // $sql = 'SELECT userid, pwd FROM users WHERE email=?';
    // $sth = $dbh->prepare($sql);
    // $sth->execute(array($email));
    $sql = "SELECT userid, pwd FROM users WHERE email='$email'";
    $sth = $dbh->query($sql);
    $result = $sth->fetch();
    if (! empty($result)) {
      $userid  = $result['userid'];
      $pwd     = $result['pwd'];
      mb_send_mail($email, 
           'パスワードをお知らせします', 
           "$userid さん、あなたのパスワードは\n" . $pwd . " です\n");
    }
  } catch (PDOException $e) {
    $logger->add('クエリに失敗しました: ' . $e->getMessage());
    die('只今サイトが大変混雑しています。もうしばらく経ってからアクセスしてください');
  }
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/common.css">
<title>パスワードリセット</title>
</head>
<body>
<div id="top">
<?php require "menu.php"; ?>
  <div id="done">
    パスワードをご指定のメールアドレスに送信しました。<BR><BR>
  </div><!-- /#done -->
<?php require "footer.php"; ?>
</div>
</body>
</html>
