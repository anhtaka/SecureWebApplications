<?php
  session_start();
  if (empty($_SESSION['mail'])) {
    $_SESSION['mail'] = 'secret@example.jp';
  }
  // メールアドレスをJSONで返す
  header('Content-Type: application/json; charset=UTF-8');
  echo json_encode(array(
    'mail'    => $_SESSION['mail']));
