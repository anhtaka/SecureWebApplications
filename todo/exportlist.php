<?php
  $sql = "todos.id IN (" . implode(",", array_keys($keys)) . ")";
  $queryarray = array('sql' => $sql, 'keys' => $keys);
  $query = base64_encode(json_encode($queryarray));
  header("Location: exportdo.php?query=$query");
  exit;
