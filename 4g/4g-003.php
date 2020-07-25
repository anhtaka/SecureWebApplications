<?php
  $callback = $_GET['callback'];
  header('Content-Type: application/javascript; charset=utf-8');
  $json = json_encode(array('time' => date('G:i')));
  echo "$callback($json);";
