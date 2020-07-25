<?php
  require_once('./common.php');
  require_loggedin();
  $id = $user->get_id();

  $icon  = $_FILES["icon"];
  $token = filter_input(INPUT_POST, TOKENNAME);
  require_token($token);
  if ($icon['error'] !== 0) {
    die('アイコン画像を指定してください');
  }
  $tmp_name = $icon["tmp_name"];
  $iconfname = $icon["name"];
  move_uploaded_file($tmp_name, "icons/$iconfname");
  try {
    $dbh = dblogin();
  
    $sql = 'UPDATE users SET icon=? WHERE id=?';
    $sth = $dbh->prepare($sql);
    $rs = $sth->execute(array($iconfname, $id));
  } catch (PDOException $e) {
    $logger->add('クエリに失敗しました: ' . $e->getMessage());
    die('只今サイトが大変混雑しています。もうしばらく経ってからアクセスしてください');
  }
?><html>
<head>
<link rel="stylesheet" type="text/css" href="css/common.css">
<title>アイコン変更</title>
</head>
<body>
<div id="top">
<?php require "menu.php"; ?>
  <div id="confirm">

  </div><!-- /#confirm -->
<?php require "footer.php"; ?>
</div>
</body>
</html>
