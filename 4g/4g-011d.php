<?php
  if (empty($_SERVER['HTTP_X_REQUESTED_WITH'])) {
    header('HTTP/1.1 403 Forbidden');
    die("不正な呼び出しです");
  }
  $zip  = $_GET['zip'];
  // 以下は郵便番号が見つからなかった場合の処理
  header('Content-Type: application/json; charset=utf-8');
  header('X-Content-Type-Options: nosniff');
  echo json_encode(array("message" => "郵便番号が見つかりません:" . $zip), JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
