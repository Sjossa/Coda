<?php
function getPerson(PDO $pdo, int $id): array | string
{
    try {
        $stmt = $pdo->prepare('SELECT * FROM persons WHERE id = :id');
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    } catch (Exception $e) {
        return $e->getMessage();
    }
}

function setPerson(PDO $pdo, string $last_name, string $first_name, string $address, string $city, string $zip_code, string $phone, int $type): string | bool
{
    try {
        $stmt = $pdo->prepare('INSERT INTO `persons`(`last_name`, `first_name`, `address`, `zip_code`, `city`, `phone`, `type`) 
        VALUES (:last_name, :first_name, :address, :zip_code, :city, :phone, :type)');
        $stmt->bindValue(':last_name', $last_name, PDO::PARAM_STR);
        $stmt->bindValue(':first_name', $first_name, PDO::PARAM_STR);
        $stmt->bindValue(':address', $address, PDO::PARAM_STR);
        $stmt->bindValue(':zip_code', $zip_code, PDO::PARAM_STR);
        $stmt->bindValue(':city', $city, PDO::PARAM_STR);
        $stmt->bindValue(':phone', $phone, PDO::PARAM_STR);
        $stmt->bindValue(':type', $type, PDO::PARAM_INT);
        $stmt->execute();
        return true;
    } catch (Exception $e) {
        return $e->getMessage();
    }
}

function updatePerson(
    PDO $pdo,
    string $last_name,
    string $first_name,
    string $address,
    string $city,
    string $zip_code,
    string $phone,
    int $type,
    int $id): bool | string
{
    try {
        $stmt = $pdo->prepare("
UPDATE `persons` SET last_name = :last_name, first_name = :first_name, address = :address, city = :city, zip_code = :zip_code, phone = :phone, type = :type 
                 WHERE id = :id");
        $stmt->bindValue(':last_name', $last_name, PDO::PARAM_STR);
        $stmt->bindValue(':first_name', $first_name, PDO::PARAM_STR);
        $stmt->bindValue(':address', $address, PDO::PARAM_STR);
        $stmt->bindValue(':city', $city, PDO::PARAM_STR);
        $stmt->bindValue(':zip_code', $zip_code, PDO::PARAM_STR);
        $stmt->bindValue(':phone', $phone, PDO::PARAM_STR);
        $stmt->bindValue(':type', $type, PDO::PARAM_INT);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return true;
    } catch (Exception $e) {
        return $e->getMessage();
    }
}