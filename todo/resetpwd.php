<?php
  require_once('./common.php');
  $token = get_token();
?><html>
<head>
<link rel="stylesheet" type="text/css" href="css/common.css">
<title>パスワードリセット</title>
</head>
<body>
<div id="top">
<?php require "menu.php"; ?>
  <div id="newuser">
    パスワードを忘れた方は登録済みメールアドレスを入力してください<BR>
    <form action="resetpwddo.php" method="POST">
    <table>
    <tr>
    <td>Eメール</td><td><input name="email" size="32"></td>
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
