<?php
  $callback = $_GET['callback'];
  if (preg_match('/\A[_a-z][_a-z0-9]*\z/i', $callback) !== 1) {
    header('HTTP/1.1 403 Forbidden');
    die('コールバック関数名が不正です');
  }
  header('Content-Type: text/javascript; charset=UTF-8');
  $json = json_encode(array('time' => date('G:i')));
  echo "$callback($json);";
