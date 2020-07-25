<?php
require_once './common.php';
require_loggedin();
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/common.css">
<title>エクスポート</title>
</head>
<body>
<div id="top">
<?php $menu = 4; require "menu.php"; ?>
  <div id="contents">
    todoをエクスポートします。「開始」ボタンを押してください<br>
    <form action="exportdo.php" method="post">
      <input type="submit" value="開始">
    </form>
  </div><!-- /#contents -->
<?php require "footer.php"; ?>
</div>
</body>
</html>
