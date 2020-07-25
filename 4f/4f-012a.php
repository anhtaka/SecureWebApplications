<body><?php
  session_cache_limiter('public');
  session_cache_expire(1);
  session_start();
  if (empty($_SESSION['user'])) {
    die("ログインしていません");
  }
  echo "ユーザ {$_SESSION['user']} でログイン中です";
?></body>
