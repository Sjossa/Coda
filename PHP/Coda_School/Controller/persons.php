<?php
/**
 * @var PDO $pdo
 */
require "Model/persons.php";
if (
    !empty($_SERVER['CONTENT_TYPE']) &&
    (
        $_SERVER['CONTENT_TYPE'] === 'application/json' ||
        str_starts_with($_SERVER['CONTENT_TYPE'], 'application/x-www-form-urlencoded')
    )
) {

    $search = isset($_GET['search']) ? $_GET['search'] : null;
    $sortby = isset($_GET['sortby']) ? $_GET['sortby'] : null;
    $persons = getAllPersons($pdo, $search, $sortby);

    if (!is_array($persons)) {
        $errors[] = $persons;
    }

    header('Content-Type: application/json');
    echo json_encode($persons);
    exit();
}
require "View/persons.php";
