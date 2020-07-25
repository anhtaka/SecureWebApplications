<head>
<script>
function init(name) {
  var span = document.getElementById('name');
  span.textContent = name;
}
</script></head>
<body onload="init('<?php echo htmlspecialchars($_GET['name'], ENT_QUOTES) ?>')">
こんにちは<span id="name"></span>さん
</body>
