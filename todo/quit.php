<?php
  require_once('./common.php');
  require_loggedin();
  $id = $user->get_id();
  // $token = get_token();
  $reqid = filter_input(INPUT_GET, 'id');
  if (empty($reqid))
    $reqid = $id;
?><html>
<head>
<link rel="stylesheet" type="text/css" href="css/common.css">
<title>退会処理</title>
</head>
<body>
<div id="top">
<?php require "menu.php"; ?>
  <div id="changepwd">
    本当に退会しますか?<BR>
    <form action="quitdo.php" method="POST">
    <table>
    <tr>
    <td>パスワード</td><td><input name="pwd" type="password" size="16"></td>
    </tr>
    <tr>
    <td></td><td><input type=submit value="退会"></td>
    </tr>
    </table>
<?php //    <input type="hidden" name="<?php e(TOKENNAME); ?=>" value="<?php e($token); ?=>"> ?>
    <input type="hidden" name="id" value="<?php e($reqid); ?>">
    </form>
  </div><!-- /#changepwd -->
<?php require "footer.php"; ?>
</div>
</body>
</html>
