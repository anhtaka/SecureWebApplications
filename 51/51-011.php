<?php
  session_start();
  $id = $_SESSION['id'];
  if (empty($_SESSION['token'])) {
    $token = bin2hex(openssl_random_pseudo_bytes(24));
    $_SESSION['token'] = $token;
  } else {
    $token = $_SESSION['token'];
  }
?>
<body>
id = <?php echo htmlspecialchars($id); ?><br>
<form action="51-012.php" method="POST">
<!-- 以下はCSRF防止用トークン -->
<input type="hidden" name="token" value="<?php echo
  htmlspecialchars($token); ?>">
<input type="submit" value="ログアウト">
</form>
<a href="51-010.php">login</a>
</body>
