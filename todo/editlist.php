<?php
require_once './common.php';
require_loggedin();
$id = $user->get_id();

$ids = @$_POST['id'];
if (empty($ids)) {
  die('項目をチェックして下さい');
}
$process = filter_input(INPUT_POST, 'process');

$result = '';

try {
  $dbh = dblogin();

  foreach ($ids as $key => $value) {
    $keys[":id_$key"] = $value;
  }
  require("$process.php");
} catch (PDOException $e) {
  die('只今サイトが大変混雑しています。もうしばらく経ってからアクセスしてください');
  $logger->add('クエリに失敗しました: ' . $e->getMessage());
}
$dbh = null;
?><html>
<head>
<link rel="stylesheet" type="text/css" href="css/common.css">
<title>一括編集</title>
</head>
<body>
<div id="top">
<?php require "menu.php"; ?>
  <div id="done">
<?php e($result); ?>しました
  </div><!-- /#done -->
<?php require "footer.php"; ?>
</div>
</body>
</html>
