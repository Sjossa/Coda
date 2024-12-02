<?php
require "connexion.php";

//recup donné bdd
$query = $pdo->query("SELECT image, titre, contenu FROM articles");

$articles = $query->fetchAll(PDO::FETCH_ASSOC);

//test pagination

// $article_pages = 3;
// $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

?>
