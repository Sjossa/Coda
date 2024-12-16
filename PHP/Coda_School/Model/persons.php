<?php

function getAllPersons(PDO $db,int $perPage, int $page = 1): array
{
    if($page !== 1) {
        $curentid = $page * $perPage - $perPage;
    }

    $query = "SELECT * FROM persons LIMIT $perPage";
    $query2 = "SELECT COUNT(*) AS nbPersons FROM persons";

    if($page !== 1) {
        $query .= " OFFSET :idstart";
    }

    try {
        $state = $db->prepare($query);
        $statement = $db->prepare($query2);
        if($page !== 1) {
            $state->bindParam(":idstart", $curentid, PDO::PARAM_INT);
        }
        $state->execute();
        $statement->execute();
        $result = $state->fetchAll(PDO::FETCH_ASSOC);
        $res = $statement->fetch(PDO::FETCH_ASSOC);
        return [$result, $res];
    } catch (Exception $e) {
        return $e->getMessage();
    }
}