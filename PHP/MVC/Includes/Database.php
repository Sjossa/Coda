<?php
$error = [];

try {
  $pdo = new PDO("mysql:host=localhost;dbname=coda_school", "root");
} catch (Exception $e) {
  $error[] = "Erreur de connexion a la BDD{$e->getMessage()}";
}


?>

