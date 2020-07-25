<?php
  require_once('./common.php');
  $id = $user->get_id();
  if (empty($id))
    $id = -1;
  $reqid = filter_input(INPUT_GET, 'id');
  $key   = filter_input(INPUT_GET, 'key');
  if (empty($reqid))
    $reqid = -1;

  try {
    $dbh = dblogin();
    $sql = "SELECT todos.id, users.userid, todo, c_date, due_date, done, org_filename, real_filename, public FROM todos INNER JOIN users ON users.id=todos.owner AND (todos.owner=? OR ?) AND (todos.owner = ? OR todos.public > 0 OR ? > 0)";
    if (! empty($key)) {
       $sql .= " AND todo LIKE '%$key%'";
    }
    $sth = $dbh->prepare($sql);
     $sth->execute(array($reqid, $reqid < 0, $id, $user->is_super()));
?><html>
<head>
<link rel="stylesheet" type="text/css" href="css/common.css">
<script src="../js/jquery-1.8.3.js"></script>
<title>一覧</title>
</head>
<body>
<div id="top">
<?php $menu = 1; require "menu.php"; ?>
  <div id="search">
    <form action="" method="get">
      <input type="text" name="key" value="<?php echo $key; ?>">
      <input type="submit" value="検索">
    </form>
  </div>
  <div id="contents">
    <form action="editlist.php" method="post">
      <table border=1>
      <tr>
      <th><input type="checkbox" onclick="checkOrClearAll(this)"></th>
      <th>ID</th>
      <th>todo</th>
      <th>登録日</th>
      <th>期限</th>
      <th>完了</th>
      <th>添付ファイル</th>
      <th>公開</th>
      </tr>
      <?php
        foreach ($sth as $row) :
      ?><tr>
      <td><input type="checkbox" name="id[]" value="<?php e($row['id']); ?>"></td>
      <td><?php e($row['userid']); ?></td>
      <td><a href="todo.php?item=<?php e($row['id']); ?>&amp;rnd=<?php e($rnd); ?>"><?php
        if ($row['done']) { 
          echo '<s>' . htmlspecialchars($row['todo']) . '</s>'; 
        } else {
          e($row['todo']); 
        }
      ?></a></td>
      <td><?php e($row['c_date']); ?></td>
      <td><?php e($row['due_date']); ?></td>
      <td><?php e($row['done'] ? '完' : ''); ?></td>
      <td><?php
        if (!empty($row['org_filename'])) {
          echo "<a target=\"_blank\" href=\"attachment/${row['real_filename']}\">${row['org_filename']}</a>";
        } 
      ?></td>
      <td><?php e($row['public'] ? 'OK' : ''); ?></td>
      </tr>
      <?php
          endforeach;
        } catch (PDOException $e) {
          $logger->add('クエリに失敗しました: ' . $e->getMessage());
          die('只今サイトが大変混雑しています。もうしばらく経ってからアクセスしてください');
        }
      ?>
      </table><br>
      <button type="submit" name="process" value="dellist">削除</button>
      <button type="submit" name="process" value="donelist">完了</button>
      <button type="submit" name="process" value="exportlist">エクスポート</button>
    </form>
    <br>
  </div><!-- /#contents -->
<?php require "footer.php"; ?>
</div>
<script>
window.addEventListener("hashchange", check, false);

function checkOrClearAll(checkbox) {
  $('input[name="id[]"]').prop('checked', checkbox.checked);
}

function check() {
  var checklist = decodeURIComponent (location.hash.slice(1));
  if (checklist === 'all') {
    $('input[name="id[]"]').prop('checked', true);
  } else {
    var a = checklist.split(',');
    a.map(function(id) {
      $('input[name="id[]"][value="' + id + '"]').prop('checked', true);
    });
  }
}

$(function() {
  check();
});
</script>
</body>
</html>
