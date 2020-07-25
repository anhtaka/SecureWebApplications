<?php
  if ($_SERVER['REQUEST_METHOD'] === "OPTIONS") {
    if ($_SERVER['HTTP_ORIGIN'] == "http://example.jp") {
      header('Access-Control-Allow-Origin: http://example.jp');
      header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
      header('Access-Control-Allow-Headers: Content-Type');
      header('Access-Control-Max-Age: 10');
      header("Content-Length: 0");
      header("Content-Type: text/plain");
    } else {
      header("HTTP/1.1 403 Access Forbidden");
      header("Content-Type: text/plain");
      echo "このリクエストは継続できません";
    }
  } elseif ($_SERVER['REQUEST_METHOD'] === "POST") {
    header('Content-Type: application/json');
    header('Access-Control-Allow-Origin: http://example.jp');
    header('Access-Control-Max-Age: 10');
    echo json_encode(['zipcode' => '100-0100', 'address' => '東京都大島町']);
  } else {
    die('Invalid Request');
  }
