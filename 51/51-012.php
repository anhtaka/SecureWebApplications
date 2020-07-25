<?php
  session_start();
  $p_token = filter_input(INPUT_POST, 'token');
  $s_token = @$_SESSION['token'];
  if (empty($p_token) || $p_token !== $s_token) {
    die('ログアウトボタンからログアウトしてください');
  }
  $_SESSION = array();
  session_destroy();
?><body>
ログアウトしました<br>
<a href="51-011.php">back</a>
</body>
