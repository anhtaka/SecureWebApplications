<?php
  session_start();
  if (empty($_SESSION['userid'])) { // ログインしたことにする
    $_SESSION['userid'] = 'secret';
    $_SESSION['mail']   = 'secret@example.jp';
  }
?><body>
ログインしました<br>
ID: <?php echo htmlspecialchars($_SESSION['userid']); ?><br>
メールアドレス: <?php echo htmlspecialchars($_SESSION['mail']); ?>
</body>
