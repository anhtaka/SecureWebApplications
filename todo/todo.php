<?php
  require_once('./common.php');
  $item = $_GET['item'];
  $id = $user->get_id();

  try {
    $dbh = dblogin();
    $sql = "SELECT todos.id, users.userid, users.icon, todo, c_date, due_date, done, org_filename, real_filename, public FROM todos INNER JOIN users ON todos.id = ? AND users.id = todos.owner AND (todos.owner = ? OR todos.public > 0 OR ? > 0)";

    $sth = $dbh->prepare($sql);
    $sth->execute(array($item, $id, $user->is_super()));
    $result = $sth->fetch();
  } catch (PDOException $e) {
    $logger->add('クエリに失敗しました: ' . $e->getMessage());
    die('只今サイトが大変混雑しています。もうしばらく経ってからアクセスしてください');
  }
?><html>
<head>
<link rel="stylesheet" type="text/css" href="css/common.css">
<title>Todo詳細</title>
</head>
<body>
<div id="top">
<?php require "menu.php"; ?>
  <div id="contents">
    <?php if (! empty($result)): ?>
      <table style="width: 70%;">
      <tr>
      <td>ID</td><td><?php e($result['userid']); ?><img src="resize.php?path=icons&basename=<?php e($result['icon']); ?>&size=64"></td>
      </tr>
      <tr>
      <td>todo</td><td><?php 
        $todo = htmlspecialchars($result['todo'], ENT_QUOTES, 'UTF-8');
        $todo = preg_replace('|https?://[a-zA-Z0-9\+\$\;\?\.%,!#~*/:@&=_-]+|', '<a href="${0}">${0}</a>', $todo);
        echo $todo;
      ?></td>
      </tr>
      <tr>
      <td>登録日</td><td><?php e($result['c_date']); ?></td>
      </tr>
      <tr>
      <td>期限</td><td><?php e($result['due_date']); ?></td>
      </tr>
      <tr>
      <td>完了</td><td><?php e($result['done'] ? '完了' : '未'); ?></td>
      </tr>
      <tr>
      <td>添付ファイル</td><td><?php if (! empty($result['org_filename'])):
        e($result['org_filename']); ?>
        <form action="delfile.php" method="POST" style="display:inline;">
        <input type="hidden" name="item" value="<?php e($item); ?>">
        <input type="hidden" name="<?php e(TOKENNAME); ?>" value="<?php e(get_token()); ?>">
        <input type="submit" value="削除">
        </form>
        <?php endif; ?>
      </tr>
      <tr>
      <td>公開</td><td><?php e($result['public'] ? '公開' : '未公開'); ?></td>
      </tr>
      </table>
      <form action="edittodo.php">
      <input type="hidden" name="rnd" value="<?php e($rnd); ?>">
      <input type="hidden" name="item" value="<?php e($result['id']); ?>">
      <input type="submit" value="編集">
      </form>
    <?php else: ?>
      選択された項目は存在しないか、権限がありません。
    <?php endif; ?>
  </div><!-- /#contents -->
<?php require "footer.php"; ?>
</div>
</body>
</html>
