<?php
  $autologin = (@$_GET['autologin'] === 'on');
  $timeout = 30 * 60;
  if ($autologin) {
    $timeout = 7 * 24 * 60 * 60;
    session_set_cookie_params($timeout);
  }
  session_start();
  session_regenerate_id(true);
  $_SESSION['id'] = 'yamada';   // ログイン機能がないので yamada で仮置き
  $_SESSION['timeout'] = $timeout;
  $_SESSION['expires'] = time() + $timeout;
?>
<body>
login successful<a href="51-003.php">next</a>
</body>
