<?php
  $mail = filter_input(INPUT_POST, 'mail');

  $descriptorspec = array(0 => array("pipe", "r"));
  $env = array('e_mail' => $mail);
  
  $process = proc_open('/usr/sbin/sendmail -i "$e_mail"', $descriptorspec, $pipes, getcwd(), $env);
  
  if (is_resource($process)) {
    fwrite($pipes[0], file_get_contents('template.txt'));
    fclose($pipes[0]);
    proc_close($process);
  }
?>
<body>
お問い合わせを受け付けました
</body>
