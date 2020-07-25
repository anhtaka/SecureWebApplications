<?php
  session_start();
  if (empty($_SESSION['mail'])) {
    $_SESSION['mail']   = 'secret@example.jp';
  }
  if (empty($_SESSION['token'])) { // トークンがなければ生成する
    $token = bin2hex(openssl_random_pseudo_bytes(24));
    $_SESSION['token'] = $token;
  }
  // メールアドレス、トークンをJSONで返す
  header('Content-Type: application/json; charset=UTF-8');
  $json = json_encode(array(
    'mail'   => $_SESSION['mail'],
    'token'  => $_SESSION['token']));
  echo $json;
