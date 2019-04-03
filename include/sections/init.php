<?php

$host = '127.0.0.1';
$db   = 'site';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

$user = 'db_user';
$pass = 'pass';

$options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
$options[PDO::ATTR_DEFAULT_FETCH_MODE] = PDO::FETCH_ASSOC;
$options[PDO::ATTR_EMULATE_PREPARES] = false;

try {
  $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
  throw new PDOException($e->getMessage(), (int)$e->getCode());
}

$sql = 'SELECT * FROM page WHERE pageKey = ?';
$page_query = $pdo->prepare($sql);

$page = "home";
$page_data;

if (isset($_GET['p'])) {
  $tmp = trim(strtolower(strip_tags($_GET['p'])));
  $page_query->execute([$tmp]);

  if ($page_query->rowCount() == 1) {
    $page = $tmp;
    $page_data = $page_query->fetch();
  } else {
    $page_query->execute(['home']);
    $page_data = $page_query->fetch();
  }
} else {
  $page_query->execute(['home']);
  $page_data = $page_query->fetch();
}
