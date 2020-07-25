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
<title>パスワード変更</title>
</head>
<body>
<div id="top">
<?php require "menu.php"; ?>
  <div id="changepwd">
    パスワード変更(<?php e($requserid); ?>)<BR>
    <form action="changepwddo.php" method="POST">
    <table>
    <tr>
    <td>パスワード</td><td><input name="newpwd" type="password" size="16"></td>
    </tr>
    <tr>
    <td>パスワード（再）</td><td><input name="newpwd2" type="password" size="16"></td>
    </tr>
    <tr>
    <td></td><td><input type=submit value="変更"></td>
    </tr>
    </table>
    <input type="hidden" name="<?php e(TOKENNAME); ?>" value="<?php e($token); ?>">
    <input type="hidden" name="id" value="<?php e($reqid); ?>">
    </form>
  </div><!-- /#changepwd -->
<?php require "footer.php"; ?>
</div>
</body>
</html>
