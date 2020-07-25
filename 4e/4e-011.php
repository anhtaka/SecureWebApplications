<?php
  require '4e-012.php';
  $colors = unserialize($_COOKIE['COLORS']);
//var_dump($colors);
  echo "好きな色は ";
  foreach ($colors as $color) {
    echo htmlspecialchars($color, ENT_COMPAT, 'UTF-8'), ' '; 
  }
  echo "です";
  
