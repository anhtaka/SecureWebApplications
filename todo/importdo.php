<?php
require_once './common.php';
require_loggedin();
$xmlfile = $_FILES["attachment"];

$id = $user->get_id();
if ($xmlfile['error'] !== 0) {
  die('XMLフアイルがありません');
}
$tmp_name = $xmlfile["tmp_name"];
$doc = new DOMDocument();
$doc->load($tmp_name);
$todolist = $doc->getElementsByTagName('todo');

try {
  $dbh = dblogin();
  $dbh->beginTransaction();

  for ($i = 0; $i < $todolist->length; $i++) {
    $todo = $todolist->item($i);
    $subject = $todo->getElementsByTagName('subject')->item(0)->textContent;
    $c_date = $todo->getElementsByTagName('c_date')->item(0)->textContent;
    $due_date = $todo->getElementsByTagName('due_date')->item(0)->textContent;
    $done = $todo->getElementsByTagName('done')->item(0)->textContent;
    $public = $todo->getElementsByTagName('public')->item(0)->textContent;
    if (empty($due_date)) $due_date = null;
    $sql = 'INSERT INTO todos (owner, todo, c_date, due_date, done, public) VALUES(?, ?, ?, ?, ?, ?)';
    $sth = $dbh->prepare($sql);
    $rs = $sth->execute(array($id, $subject, $c_date, $due_date, $done, $public));
  }
  $dbh->commit();
} catch (PDOException $e) {
  $dbh->rollBack();
  $logger->add('クエリに失敗しました: ' . $e->getMessage());
  die('只今サイトが大変混雑しています。もうしばらく経ってからアクセスしてください');
}
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/common.css">
<title>インポート</title>
</head>
<body>
<div id="top">
<?php $menu = 3; require "menu.php"; ?>
  <div id="done">
    <?php e($todolist->length); ?> 件登録しました
  </div><!-- /#done -->
<?php require "footer.php"; ?>
</div>
</body>
</html>
