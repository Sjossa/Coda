<?php
/**
* @var PDO $pdo
 */
require "Model/dashbord.php";

$users = get_users($pdo);

if(!empty($_SESSION['username'])) {
    $username = "Bienvenue {$_SESSION['username']}";
} else {
    $username = "Bienvenue";
}



require "View/dashbord.php";