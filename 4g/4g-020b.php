<?php
  session_start();
  if (empty($_SESSION['mail'])) {
    $_SESSION['mail'] = 'secret@example.jp';
  }
  if (empty($_COOKIE['CSRF_TOKEN'])) { // トークンがなければ生成する
    $token = bin2hex(openssl_random_pseudo_bytes(24));
    setcookie('CSRF_TOKEN', $token);
  }
  // メールアドレスをJSONで返す
  header('Content-Type: application/json; charset=UTF-8');
  echo json_encode(array(
    'mail'    => $_SESSION['mail']));
