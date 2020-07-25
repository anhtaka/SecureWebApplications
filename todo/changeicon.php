<?php
  require_once('./common.php');
  require_loggedin();
  $id = $user->get_id();
  $token = get_token();
  $reqid = filter_input(INPUT_GET, 'id');
  if (empty($reqid))
    $reqid = $id;
  try {
    $dbh = dblogin();
    $sql = "SELECT userid FROM users WHERE id=?";
    $sth = $dbh->prepare($sql);
    $sth->execute(array($reqid));
    $result = $sth->fetch();
    $requserid = $result['userid'];
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
  <div id="newuser">
    アイコン変更(<?php e($requserid); ?>)<BR>
    <form action="changeicondo.php" method="POST" enctype="multipart/form-data">
    <table>
    <tr>
    <td>アイコン画像</td><td><input name="icon" type="file"></td>
    </tr>
    <tr>
    <td></td><td><input type=submit value="変更"></td>
    </tr>
    </table>
    <input type="hidden" name="<?php e(TOKENNAME); ?>" value="<?php e($token); ?>">
    </form>
  </div><!-- /#newuser -->
<?php require "footer.php"; ?>
</div>
</body>
</html>
