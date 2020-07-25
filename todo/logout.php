<?php
  require_once './common.php';
  session_destroy();
  $_SESSION = array();
  setcookie(SESSIDNAME, '', 0, '/');
  setcookie('USER', '', 0, '/');
?><html>
<head>
<link rel="stylesheet" type="text/css" href="css/common.css">
<title>ログアウト</title>
</head>
<body>
<div id="top">
<?php $menu = 8; require "menu.php"; ?>
  <div id="done">
  ログアウトしました。<a href="login.php?url=todolist.php">再度ログインする</a>
  </div><!-- /#done -->
<?php require "footer.php"; ?>
</div>
</body>
</html>
