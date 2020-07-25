<?php
  header('Content-Type: application/json');
  header('Access-Control-Allow-Origin: http://example.jp');
  echo json_encode(['zipcode' => '100-0100', 'address' => '東京都大島町']);
