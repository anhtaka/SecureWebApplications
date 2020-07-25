<?php
  define('TMPLDIR', '/var/www/html/4a/tmpl/');
  $tmpl = basename(filter_input(INPUT_GET, 'template'));
?>
<body>
<?php readfile(TMPLDIR . $tmpl . '.html'); ?>
メニュー（以下略）
</body>
