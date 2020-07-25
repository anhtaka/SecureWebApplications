<?php
  require_once('./common.php');
  require_loggedin();
  $id = $user->get_id();
  $item = filter_input(INPUT_GET, 'item');
  if (empty($item)) {
    header('Location: todolist.php');
    exit;
  }
  try {
    $dbh = dblogin();

    $sql = "SELECT todos.id, users.userid, todo, c_date, due_date, done, org_filename, real_filename, public FROM todos INNER JOIN users ON todos.id = ? AND users.id = todos.owner";

    $sth = $dbh->prepare($sql);
    $sth->execute(array($item));
    $result = $sth->fetch();
  } catch (PDOException $e) {
    if ($dbh)
      $logger->add('クエリに失敗しました: ' . $e->getMessage());
    die('只今サイトが大変混雑しています。もうしばらく経ってからアクセスしてください');
  }
?><html>
<head>
<link rel="stylesheet" type="text/css" href="css/common.css">
<title>Todo編集</title>
</head>
<body>
<div id="top">
<?php require "menu.php"; ?>
  <div id="contents">
    <form action="editdone.php" method="post" enctype="multipart/form-data">
    <table style="width: 60%;">
    <tr>
    <td>ID</td><td><?php e($result['userid']); ?></td>
    </tr>
    <tr>
    <td>todo</td><td><input name="todo" value="<?php e($result['todo']); ?>"></td>
    </tr>
    <tr>
    <td>登録日</td><td><input name="c_date" value="<?php e($result['c_date']); ?>"></td>
    </tr>
    <tr>
    <td>期限</td><td><input name="due_date" value="<?php e($result['due_date']); ?>"></td>
    </tr>
    <tr>
    <td>完了</td><td><input type="checkbox" name="done" value="1" <?php if ($result['done']) e('checked="checked"'); ?>></td>
    </tr>
    <tr>
    <td>添付ファイル</td><td><?php e($result['org_filename']); ?> <input name="attachment" type="file"></td>
    </tr>
    <tr>
    <td>公開</td><td><input type="checkbox" name="public" value="1" <?php if ($result['public']) e('checked="checked"'); ?>></td>
    </tr>
    <tr>
    <td></td><td><input type="submit" value="更新"></td>
    </tr>
    </table>
    <input type="hidden" name="<?php e(TOKENNAME); ?>" value="<?php e(get_token()); ?>">
    <input type="hidden" name="item" value="<?php e($item); ?>">
    </form>
  </div><!-- /#contents -->
<?php require "footer.php"; ?>
</div>
</body>
</html>
