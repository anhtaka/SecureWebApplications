<?php
  $callback = $_GET['callback'];
  $json = json_encode(array('time' => date('G:i')));
  echo "$callback($json);";
