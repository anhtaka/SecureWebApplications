<?php
session_start();
function escape_js($s) {
  return mb_ereg_replace('([\\\\\'"])', '\\\1', $s);
}
?>
<body>
<div id="name"></div>
<script>
  var div = document.getElementById('name');
  var txt = '<?php echo escape_js($_GET['name']); ?>';
  div.textContent = txt + 'の文字数は' + txt.length + '文字です';
</script>
</body>
