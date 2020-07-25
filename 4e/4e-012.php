<?php
class Logger {
  const LOGDIR = '/tmp/';  // ログ出力ディレクトリ
  private $filename = '';  // ログファイル名
  private $log = '';       // ログバッファ

  public function __construct($filename) {
    $this->filename = basename($filename); // ファイル名
    $this->log = '';             // ログバッファ
  }

// デストラクタではバッファの中身をファイルに書き出し
  public function __destruct() {
    $path = self::LOGDIR . $this->filename;  // ファイル名の組み立て
// var_dump($path);
    $fp = fopen($path, 'a');
    if ($fp === false) {
      die('Logger: ファイルがオープンできません' . htmlspecialchars($path));
    }
    if (! flock($fp, LOCK_EX)) {   // 排他ロックする
      die('Logger: ファイルのロックに失敗しました');
    }
    fwrite($fp, $this->log); // ログの書き出し
    fflush($fp);             // フラッシュしてからロック解除
    flock($fp, LOCK_UN);
    fclose($fp);
  }

  public function add($log) {  // ログ出力
    $this->log .= $log;        // バッファに追加するだけ
  }
}
