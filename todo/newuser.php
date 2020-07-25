<?php
  require_once('./common.php');
?><html>
<head>
<link rel="stylesheet" type="text/css" href="css/common.css">
<title>会員登録</title>
</head>
<body>
<div id="top">
<?php require "menu.php"; ?>
<div id="newuser">
会員登録<BR>
<form action="confirmuser.php" method="POST" enctype="multipart/form-data">
<table>
<tr>
<td>ユーザID</td><td><input name="id" size="16"></td>
</tr>
<tr>
<td>パスワード(8文字以内)</td><td><input name="pwd" type="password" size="16"></td>
</tr>
<tr>
<td>Eメール</td><td><input name="email" size="32"></td>
</tr>
<tr>
<td>アイコン画像(PNG, JPEG)</td><td><input name="icon" type="file"></td>
</tr>
<tr>
<td></td><td><input type=submit value="確認"></td>
</tr>
</table>
</form>
  </div><!-- /#newuser -->
<?php require "footer.php"; ?>
</div>
</body>
</html>
