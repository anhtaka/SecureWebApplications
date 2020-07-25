<?php
  if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    if($_SERVER['HTTP_ORIGIN'] === 'http://example.jp') {
      header('Access-Control-Allow-Origin: http://example.jp');
      header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
      header('Access-Control-Allow-Headers: Content-Type');
      header('Access-Control-Max-Age: 1728000');
      header('Content-Length: 0');
      header('Content-Type: text/plain');
    } else {
      header('HTTP/1.1 403 Access Forbidden');
      header('Content-Type: text/plain');
      echo "このリクエストは継続できません";
    }
  } else {
    die('Invalid Request');
  }
