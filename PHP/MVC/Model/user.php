<?php

function get(PDO $pdo, int $id)
{
  try {
    $state = $pdo->prepare("SELECT username, email, enabled FROM users WHERE id = :id");
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
