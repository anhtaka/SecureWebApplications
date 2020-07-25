<body><?php
  $user = $_GET['user'];
  if ($user === 'tanaka' || $user === 'yamada') {
    session_start();
    session_regenerate_id(true);
    $_SESSION['user'] = $user;
    echo 'ログインしました(' . htmlspecialchars($user) . ')<br>';
    echo '<a href="4f-012.php">マイページ（キャッシュなし）</a><br>';
    echo '<a href="4f-012a.php">マイページ（キャッシュあり）</a>';
  } else {
    echo 'ユーザ名が違います';
  }
?>
</body>
