<?php
  $sql = "DELETE FROM todos WHERE id IN (" . implode(",", array_keys($keys)) . ")";
  $sth = $dbh->prepare($sql);
  $sth->execute($keys);
  $result = $sth->rowCount() . '件削除';
