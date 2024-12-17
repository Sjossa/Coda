<?php
function getAll(PDO $pdo, $search = null, string | null $sortby = null): array | string
{
    $query = "SELECT * FROM users LIMIT 10";
    if($search !== null) {
        $query .= " WHERE username LIKE :search OR id LIKE :search OR email LIKE :search";
    }
    if($sortby !== null) {
        $query .= " ORDER BY $sortby";
    }
    try {
        $state = $pdo->prepare($query);
        if($search !== null) {
            $state->bindValue(":search", "%$search%");
        }
        $state->execute();
        return $state->fetchAll();
    } catch (PDOException $e) {
        return $e->getMessage();
    }

}

function toogle_enabled(PDO $pdo, int $user_id): string | bool
{
    try {
        $state = $pdo->prepare("UPDATE `users` SET `enabled` = NOT `enabled` WHERE `id` = :user_id");
        $state->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $state->execute();
        return true;
    } catch (Exception $e) {
        return $e->getMessage();
    }

}

function delete_user(PDO $pdo, int $user_id)
{
    try {
        $state = $pdo->prepare("DELETE FROM `users` WHERE `id` = :user_id");
        $state->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $state->execute();
    } catch (PDOException $e) {
        return $e->getMessage();
    }

}