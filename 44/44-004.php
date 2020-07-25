<?php
  header('Content-Type: text/html; charset=UTF-8');
  $author = $_GET['author'];
  try {
    $opt = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                 PDO::MYSQL_ATTR_MULTI_STATEMENTS => false,
                 PDO::ATTR_EMULATE_PREPARES => false);
//    if (defined('PDO::MYSQL_ATTR_MULTI_STATEMENTS')) {
//      $opt[PDO::MYSQL_ATTR_MULTI_STATEMENTS] = false;
//    }

    $db = new PDO("mysql:host=127.0.0.1;dbname=wasbook;charset=utf8", "wasbook", "wasbook", $opt);
    $sql = "SELECT * FROM books WHERE author = ? ORDER BY id";
    $ps = $db->prepare($sql);
    $ps->bindValue(1, $author, PDO::PARAM_STR);
    $ps->execute();
?>
<html>
<body>
<table border=1>
<tr>
<th>蔵書ID</th>
<th>タイトル</th>
<th>著者名</th>
<th>出版社</th>
<th>出版年月</th>
<th>価格</th>
</tr>
<?php
    while ($row = $ps->fetch()) {
      echo "<tr>\n";
      for ($col = 0; $col < 6; $col++) {
        echo "<td>" . $row[$col] . "</td>\n";
      }
      echo "</tr>\n";
    }
  } catch (PDOException $e) {
    error_log("Query Error : " . $e->getMessage());
    die("ただいまサイトが大変混雑しています。しばらく経ってからご利用ください");
  }
?>
</table>
</body>
</html>
