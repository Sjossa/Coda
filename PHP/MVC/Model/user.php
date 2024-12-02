<?php

function get(PDO $pdo, int $id)
{
  try {
    $state = $pdo->prepare("SELECT * FROM users WHERE id = :id");
    $state->bindParam(':id', $id, PDO::PARAM_INT);
    $state->execute();
    return $state->fetch();
  } catch (Exception $e) {
    return "Erreur de requete : {$e->getMessage()}";
  }
}

function _count(PDO $pdo, string $username, int $id)
{
  try {
    $state = $pdo->prepare("SELECT COUNT(*) AS user_number FROM users
                               WHERE username = :username AND id <> :id");
    $state->bindParam(':username', $username, PDO::PARAM_STR);
    $state->bindParam(':id', $id, PDO::PARAM_INT);
    $state->execute();
    return $state->fetch();
  } catch (Exception $e) {
    return "Erreur de verification du username {$e->getMessage()}";
  }
}

function update(PDO $pdo, int $id, string $username, string $email, bool $enabled)
{
  try {
    $state = $pdo->prepare("UPDATE `users` SET username = :username,
                   email = :email, enabled = :enabled WHERE id = :id");
    $state->bindParam(':id', $id, PDO::PARAM_INT);
    $state->bindParam(':username', $username);
    $state->bindParam(':email', $email);
    $state->bindParam(':enabled', $enabled, PDO::PARAM_BOOL);
    $state->execute();
  } catch (Exception $e) {
    return "Erreur de requete : {$e->getMessage()}";
  }
}

function updatePassword(PDO $pdo, int $id, string $password)
{
  try {
    $state = $pdo->prepare("UPDATE `users` SET password = :password WHERE id = :id");
    $state->bindParam(':id', $id, PDO::PARAM_INT);
    $state->bindParam(':password', $password);
    $state->execute();
  } catch (Exception $e) {
    return "Erreur de requete : {$e->getMessage()}";
  }
}

function emailExists(PDO $pdo, string $email)
{
    try {
        $state = $pdo->prepare("SELECT COUNT(*) AS email_count FROM `users` WHERE `email` = :mail");
        $state->bindParam(':mail', $email, PDO::PARAM_STR);
        $state->execute();
        return $state->fetch()['email_count'] > 0;
    } catch (Exception $e) {
        return "Erreur de vérification de l'email : {$e->getMessage()}";
    }
}


function create(PDO $pdo, string $username, string $password, string $email, bool $enabled){
    try {
        $state = $pdo->prepare(
            "INSERT INTO `users`(`username`, `password`, `email`, `enabled`)
             VALUES (:username, :password, :mail, :enable)"
        );
        $state->bindValue(':username', $username, PDO::PARAM_STR);
        $state->bindValue(':password', $password, PDO::PARAM_STR);
        $state->bindValue(':mail', $email, PDO::PARAM_STR);
        $state->bindValue(':enable', $enabled, PDO::PARAM_BOOL);
        $state->execute();
    } catch (Exception $e) {
        return "Erreur lors de la création de l'utilisateur : {$e->getMessage()}";
    }
  }
