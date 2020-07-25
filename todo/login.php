<?php
  require_once('./common.php');
  $url = filter_input(INPUT_GET, 'url');
  if (empty($url)) {
    $url = "todolist.php";
  }
?><html>
<head>
<link rel="stylesheet" type="text/css" href="css/common.css">
<title>ログイン</title>
</head>
<body>
<div id="top">
<?php $menu = 8; require "menu.php"; ?>
  <div id="loginform">
    <form action="logindo.php?" method="post">
    ログインしてください
    <table border="0">
    <tr>
    <td>id</td><td><input type="text" name="userid"></td>
    </tr>
    <tr>
    <td>パスワード</td><td><input type="text" name="pwd"></td>
    </tr>
    <tr>
    <td></td><td><input type="submit" value="ログイン"></td>
    </tr>
    </table>
    <input type=hidden name="url" value="<?php e($url); ?>">
    </form><BR>
    <a href="resetpwd.php">パスワードを忘れた方</a><br>
    初めての方は<a href="./newuser.php?">こちら</a>から会員登録してください<br>
  </div><!-- /#loginform -->
<?php require "footer.php"; ?>
</div>
</body>
</html>
