<body><?php
  $user = $_GET['user'];
  if ($user === 'tanaka' || $user === 'yamada') {
    session_start();
    session_regenerate_id(true);
    $_SESSION['user'] = $user;
    echo 'ログインしました(' . htmlspecialchars($user) . ')<br>';
    echo '<a href="4f-022.php">マイページ</a><br>';
  } else {
    echo 'ユーザ名が違います';
  }
?>
</body>
