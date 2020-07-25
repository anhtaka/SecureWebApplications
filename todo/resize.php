<?php
  $path = $_GET['path'];
  $basename = $_GET['basename'];
  $file = "$path/$basename";
  $size = 0;
  if (isset($_GET['size'])) {
    $size = $_GET['size'];
    $xfile = "$path/_${size}_$basename";
    if (! file_exists($xfile)) {
       copy($file, $xfile);
       // 当初ImageMagicを使っていたがあまりにサイズが大きいのでimgpに変更
       // error_log("imgp -x {$size}x{$size} -w {$xfile}");
       exec("imgp -x {$size}x{$size} -w {$xfile}");
    }
  } else {
    $xfile = $file;
  }
  
  header("Content-Type: image/jpg");
  header("Content-Length: " . @filesize($xfile));
  @readfile($xfile);
  // todo : Content-Typeの切り替え 
