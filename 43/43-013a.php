<?php
session_start();
?>
<body>
<div id="name" data-name="<?php echo htmlspecialchars($_GET['name'], ENT_COMPAT, 'utf-8'); ?>"></div>
<script>
  var div = document.getElementById('name');
  var txt = div.dataset.name;
  div.textContent = txt + 'の文字数は' + txt.length + '文字です';
</script>
</body>
