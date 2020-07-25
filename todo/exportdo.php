<?php
  require_once('./common.php');
  $where = '';
  $keys = array();
  $query = filter_input(INPUT_GET, 'query');
  if (!empty($query)) {
    $queryarray= json_decode(base64_decode($query), true);
    $where = $queryarray['sql'];
    $keys = $queryarray['keys'];
  } else {
    $where = "users.userid=:id";
    $keys = array(':id' => $user->get_userid());
  }
  try {
    $dbh = dblogin();
    $sql = "SELECT todos.id, users.userid, todo, c_date, due_date, done, public FROM todos INNER JOIN users ON users.id=todos.owner AND $where";
    $sth = $dbh->prepare($sql);
    $sth->execute($keys);
    $dom = new DomDocument('1.0', 'UTF-8');
    $todolist = $dom->appendChild($dom->createElement('todolist')); 
  
    foreach ($sth as $row) {
      $todo = $todolist->appendChild($dom->createElement('todo'));
      $todo->appendChild($dom->createElement('owner', $row['userid']));
      $todo->appendChild($dom->createElement('subject', $row['todo']));
      $todo->appendChild($dom->createElement('c_date', $row['c_date']));
      $todo->appendChild($dom->createElement('due_date', $row['due_date']));
      $todo->appendChild($dom->createElement('done', $row['done']));
      $todo->appendChild($dom->createElement('public', $row['public']));
    }
    $dom->formatOutput = true;
    $xml = $dom->saveXML();

    header('Content-Type: application/xml');
    header('Content-Disposition: attachment; filename="export.xml"');
    header('Content-Length: ' . strlen($xml));
    echo $xml;
  } catch (PDOException $e) {
    $logger->add('クエリに失敗しました: ' . $e->getMessage());
    die('只今サイトが大変混雑しています。もうしばらく経ってからアクセスしてください');
  }
?>
