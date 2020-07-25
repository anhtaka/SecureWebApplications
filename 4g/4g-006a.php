<?php
  $zip  = $_GET['zip'];
  // 以下は郵便番号が見つからなかった場合の処理
  $json = json_encode(array("message" => "郵便番号が見つかりません:" . $zip));
  header('Content-Type: text/javascript; charset=utf-8');
  echo "callback_zip($json);";
