<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=coda_school', 'root');
} catch (Exception $e) {
    $error[] = "BDD conect error : {$e->getMessage()}";
}
