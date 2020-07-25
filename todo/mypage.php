<?php
  require_once('./common.php');
  $id = $user->get_id();
  $reqid = filter_input(INPUT_GET, 'id');
  $ok = $user->is_super() || $id === $reqid;
  if ($ok) {
    try {
      $dbh = dblogin();
      $sql = "SELECT id, userid, pwd, email, icon FROM users WHERE id=?";
      $sth = $dbh->prepare($sql);
      $sth->execute(array($reqid));
      $result = $sth->fetch();
      if (empty($result)) {
        $ok = false;
      } else {
        $email = $result['email'];
        $pwd   = $result['pwd'];
        $icon  = $result['icon'];
      }
    } catch (PDOException $e) {
      $logger->add('クエリに失敗しました: ' . $e->getMessage());
      die('只今サイトが大変混雑しています。もうしばらく経ってからアクセスしてください');
    }
  }
?><html>
<head>
<link rel="stylesheet" type="text/css" href="css/common.css">
<title>マイページ</title>
</head>
<body>
<div id="top">
<?php $menu = 5; require "menu.php"; ?>
  <div id="contents">
  <?php if ($ok) : ?>
    <table style="width: 70%;">
    <tr>
    <td>ID</td><td><?php e($result['userid']); ?></td>
    </tr>
    <tr>
    <td>メールアドレス</td><td><?php e($email); ?> <a href="changemail.php?id=<?php e($reqid); ?>">変更</a></td>
    </tr>
    <tr>
    <td>パスワード</td><td>****** <a href="changepwd.php?id=<?php e($reqid); ?>">変更</a></td>
    </tr>
    <tr>
    <td>アイコン</td><td><img src="resize.php?path=icons&basename=<?php e($icon); ?>&size=64"><a href="changeicon.php?id=<?php e($reqid); ?>">変更</a></td>
    </tr>
    </table>
    <a href="quit.php?id=<?php e($reqid); ?>">退会する</a>
  <?php else : ?>
    権限がないか、そのユーザは存在しません
  <?php endif; ?>
  </div><!-- /#contents -->
<?php require "footer.php"; ?>
</div>
</body>
</html>
