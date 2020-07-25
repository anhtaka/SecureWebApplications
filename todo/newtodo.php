<?php
require_once './common.php';
require_loggedin();
$token = get_token();
?><html>
<head>
<link rel="stylesheet" type="text/css" href="css/common.css">
<title>Todo追加</title>
</head>
<body>
<div id="top">
<?php $menu = 2; require "menu.php"; ?>
  <div id="newuser">
    todo新規登録<BR>
    <form action="addtodo.php" method="POST" enctype="multipart/form-data">
    <table>
    <tr>
    <td>todo</td><td><input name="todo" size="16"></td>
    </tr>
    <tr>
    <td>納期</td><td><input name="due_date" size=3> 日後</td>
    </tr>
    <tr>
    <td><label for="public">公開</label></td><td><input name="public" id="public" type="checkbox" value="1"></td>
    </tr>
    <tr>
    <td>添付ファイル</td><td><input type="file" name="attachment"></td>
    </tr>
    <tr>
    <td></td><td><input type="submit" value="登録"></td>
    </tr>
    </table>
    <input type="hidden" name="<?php e(TOKENNAME); ?>" value="<?php e($token); ?>">
    </form>
  </div><!-- /#newuser -->
<?php require "footer.php"; ?>
</div>
</body>
</html>
