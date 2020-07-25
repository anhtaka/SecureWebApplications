<?php
require_once './common.php';
$token = get_token();
?><html>
<head>
<link rel="stylesheet" type="text/css" href="css/common.css">
<title>問い合わせ</title>
</head>
<body>
<div id="top">
<?php $menu = 6; require "menu.php"; ?>
  <div id="newuser">
    会員登録<BR>
    <form action="inquerydo.php" method="POST">
    <table>
    <tr>
    <td>件名</td><td><input name="subject" size="32"></td>
    </tr>
    <tr>
    <td>Eメール</td><td><input name="email" size="32"></td>
    </tr>
    <tr>
    <td>氏名</td><td><input name="name" size="32"></td>
    </tr>
    <tr>
    <td>質問内容</td><td><textarea name=question cols="40" rows="10"></textarea>
    </tr>
    <tr>
    <td></td><td><input type=submit value="送信"></td>
    </tr>
    </table>
    <input type="hidden" name="<?php e(TOKENNAME); ?>" value="<?php e($token); ?>">
    </form>
  </div><!-- /#newuser -->
<?php require "footer.php"; ?>
</div>
</body>
</html>
