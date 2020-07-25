<?php
session_start();
$array = array('name' => $_GET['name']);
?><body>
<div id="name"></div>
<script>
function display_length(obj) {
  var div = document.getElementById('name');
  var txt = obj.name;
  div.textContent = txt + 'の文字数は' + txt.length + '文字です';
}
display_length(<?php echo json_encode($array, JSON_HEX_TAG | JSON_HEX_AMP); ?>);
</script>
</body>
