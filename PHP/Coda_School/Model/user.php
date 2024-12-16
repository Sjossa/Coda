<?php
function getUser(PDO $pdo, int $id): array | string
{
    try {
        $state = $pdo->prepare("SELECT * FROM `users` WHERE id = :id");
        $state->bindValue(":id", $id, PDO::PARAM_INT);
        $state->execute();
        return $state->fetch();
    } catch (Exception $e) {
        return $e->getMessage();
    }
}

function verif_email(PDO $pdo, string $email, $id = null): array | string
{
    $query = "SELECT COUNT(*) AS usernb FROM `users` WHERE `email` = :mail";
    if ($id !== null) {
        $query .= " AND `id` <> :id";
    }

    try {
        $state = $pdo->prepare($query);
        $state->bindParam(':mail', $email);
        if($id !== null){
            $state->bindParam(':id', $id, PDO::PARAM_INT);
        }
        $state->execute();
        return $state->fetch();
    } catch (Exception $e) {
        return $e->getMessage();
    }
}

function update_name(PDO $pdo, int $id, string $username, string $email, bool $enable)
{
    try {
        $statement = $pdo->prepare("UPDATE `users` SET username = :username, email = :email, enabled = :enabled WHERE id = :id");
        $statement->bindParam(":username", $username);
        $statement->bindParam(":email", $email);
        $statement->bindParam(":enabled", $enable, PDO::PARAM_BOOL);
        $statement->bindParam(":id", $id, PDO::PARAM_INT);
        $statement->execute();
    } catch (Exception $e) {
        return $e->getMessage();
    }
}

function update_password(PDO $pdo, int $id, string $password) {
    try {
        $statement = $pdo->prepare("UPDATE `users` SET password = :password WHERE id = :id");
        $statement->bindParam(":password", $password);
        $statement->bindParam(":id", $id, PDO::PARAM_INT);
        $statement->execute();
    }  catch (Exception $e) {
        return $e->getMessage();
    }
}

function new_user(PDO $pdo, string $username, string $email, string $password, bool $enable)
{
    try {
        $state = $pdo->prepare("INSERT INTO `users`(`username`, `password`, `email`, `enabled`) 
        VALUES (:username, :password, :mail, :enable)");
        $state->bindValue(':username', $username);
        $state->bindValue(':password', $password);
        $state->bindValue(':mail', $email);
        $state->bindValue(':enable', $enable, PDO::PARAM_BOOL);
        $state->execute();
    } catch (Exception $e) {
        return $e->getMessage();
    }
}

?>