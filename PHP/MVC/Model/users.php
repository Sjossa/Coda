<?php

function getAll(PDO $pdo): array
{
  $res = $pdo->prepare('SELECT * FROM users');
  $res->execute();
  return $res->fetchAll();
}

function toggle_enabled(PDO $pdo, int $id): void
{
  try {
    $res = $pdo->prepare('UPDATE `users` SET enabled = NOT enabled WHERE id = :id');
    $res->bindParam(':id', $id, PDO::PARAM_INT);
    $res->execute();
  } catch (PDOException $e) {
    // En cas d'erreur, tu pourrais logguer ou retourner l'exception
    echo "Error: " . $e->getMessage();
  }
}

function deleteUser(PDO $pdo, int $id)
{
  try {
    $query = $pdo->prepare('DELETE FROM `users` WHERE id = :id');
    $query->bindParam(':id', $id, PDO::PARAM_INT);
    $query->execute();
  } catch (PDOException $e) {
    return $e->getMessage();
  }
}

?>

