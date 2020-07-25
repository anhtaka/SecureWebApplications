<?php
  $rnd = uniqid();
?><div id="header">
  <h1><a href="index.html">Bad Todo List</a></h1>
</div><!-- /#header-->
<div class="welcome">
<?php
  if (is_loggedin()) {
    $userid = $user->get_userid();
    if ($user->is_super())
      $userid .= '(管理者)';
    e("こんにちは、$userid さん");
  } else {
    e("こんにちは、ゲストさん");
  }
  if (! isset($menu)) $menu = 0;
?>
</div><!-- /#welcome -->
<div id="menu">
  <ul>
  <li><a href="todolist.php?rnd=<?php e($rnd); ?>" class="<?php e($menu === 1 ? 'on' : ''); ?>">一覧</a></li>
  <li><a href="newtodo.php?rnd=<?php e($rnd); ?>" class="<?php e($menu === 2 ? 'on' : ''); ?>">新規追加</a></li>
  <li><a href="import.php" class="<?php e($menu === 3 ? 'on' : ''); ?>">インポート</a></li>
  <li><a href="export.php" class="<?php e($menu === 4 ? 'on' : ''); ?>">エクスポート</a></li>
<?php if (is_loggedin()): ?>
  <li><a href="mypage.php?rnd=<?php e($rnd); ?>&id=<?php e($user->get_id()); ?>" class="<?php e($menu === 5 ? 'on' : ''); ?>">マイページ</a></li>
<?php  endif ?>
  <li><a href="inquery.php" class="<?php e($menu === 6 ? 'on' : ''); ?>">問い合わせ</a></li>
<?php if ($user->is_super()): ?>
  <li><a href="userlist.php?rnd=<?php e($rnd); ?>" class="<?php e($menu === 7 ? 'on' : ''); ?>">会員一覧</a></li>
<?php  endif ?>
  <li><?php
if (is_loggedin()) {
  echo '<a href="logout.php" class="', ($menu === 8) ? 'on' : '', '">ログアウト</a>';
} else
  echo '<a href="login.php?url=todolist.php" class="', ($menu === 8) ? 'on' : '', '">ログイン</a>'; ?></li>
  </ul>
</div><!-- /#menu-->
<br>
