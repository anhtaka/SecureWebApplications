<?php
  session_start();
  if (empty($_SESSION['mail'])) {
    header('HTTP/1.1 403 Forbidden');
    die('ログインが必要です');
  }
  $json = file_get_contents('php://input');
  $array = json_decode($json, true);
  // 更新処理
  $_SESSION['mail'] = $array['mail'];
  $result = array('result' => 'ok');
  header('Content-Type: application/json; charset=UTF-8');
  echo json_encode($result);
