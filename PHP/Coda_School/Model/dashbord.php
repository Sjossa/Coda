<?php
function get_users(PDO $pdo): array
{
    $state = $pdo->prepare("SELECT count(*) AS nb FROM users");
    $state->execute();
    return $state->fetch();
}