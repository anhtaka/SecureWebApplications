<?php
  session_start();
  // ユーザIDの確認
  $token = filter_input(INPUT_COOKIE, 'token');
  if (empty($token) || $token != $_SESSION['token']) {
    die('認証エラー。トークンが不正です。');
  }
?>
<body> トークンをチェックし、認証状態を確認しました </body>
