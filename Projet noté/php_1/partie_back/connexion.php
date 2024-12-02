<?php

$co = 'mysql:host=localhost;dbname=php_1';
$user = 'root';
$password = '';

try {
  $pdo = new PDO($co, $user, $password);
} catch (PDOException $e) {
  exit;
}




?>
