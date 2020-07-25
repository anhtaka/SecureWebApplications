<?php
define('UPLOADPATH', '/var/upload');
$mimes = array('pdf' => 'application/pdf');
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  header("HTTP/1.1 400 Bad Request");
  die('POSTメソッドでリクエストしてください');
}
$file = @$_POST['file'];
$orgfile = @$_POST['orgfile'];
$info = pathinfo($file);       // ファイル情報の取得
$ext = strtolower($info['extension']);     // 拡張子
$content_type = $mimes[$ext]; // Content-Typeの取得
if (! $content_type) {
  header("HTTP/1.1 400 Bad Request");
  die('拡張子はpdfを指定ください');
}
if (preg_match('/[\r\n]/', $orgfile) === 1) {
  header("HTTP/1.1 400 Bad Request");
  die('orgfileに改行を含めることはできません');
}
header('Content-Type: ' . $content_type);
header('X-Content-Type-Options: nosniff');
header('X-Download-Options: noopen');
header('Content-Disposition: attachment; filename="' . $orgfile  . '"');
readfile(UPLOADPATH . '/' . basename($file));
?>
