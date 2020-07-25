<?php
  $colors = array('red', 'green', 'blue');
  setcookie('COLORS', json_encode($colors));
//  var_dump(json_encode($colors));
  echo "クッキーをセットしました";
