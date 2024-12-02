<?php

function getAll(PDO $pdo, string|null $search = null, string|null $sortBy = null): array
{
  $query = 'SELECT * FROM users';

  if (null !== $search) {
    $query .= ' WHERE id LIKE :search OR username LIKE :search OR email LIKE :search';
  }
  if (null !== $sortBy) {
    $query .= " ORDER BY $sortBy";
  }
  try {
    $res = $pdo->prepare($query);

    if (null !== $search) {
      $res->bindValue(':search', "%$search%");
    }
    $res->execute();
    return $res->fetchAll();
  } catch (Exception $e) {
    return ['error' => $e->getMessage()];
  }
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

