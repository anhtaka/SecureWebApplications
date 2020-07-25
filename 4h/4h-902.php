<body>
IDとパスワードを盗みました<br>
ID: <?php echo htmlspecialchars($_POST['id']); ?><br>
パスワード: <?php echo htmlspecialchars($_POST['pwd']); ?><br>
10秒後に本来のURLに遷移します。
<script>
  setTimeout(function() {
      location.href="http://example.jp/4h/4h-021.html";
    }, 10000);
</script>
</body>
