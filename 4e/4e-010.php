<?php
  $colors = array('red', 'green', 'blue');
  setcookie('COLORS', serialize($colors));
  echo "クッキーをセットしました";

