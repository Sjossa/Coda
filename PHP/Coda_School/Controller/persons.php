<?php
/**
 * @var PDO $pdo
 */
    require "Model/persons.php";


    $search = isset($_GET['search']) ? $_GET['search'] : null;
    $sortby = isset($_GET['sortby']) ? $_GET['sortby'] : null;
    $persons = getAllPersons($pdo, $search, $sortby);

    if (!is_array($persons)){
        $errors[] = $persons;
    }

    require "View/persons.php";
