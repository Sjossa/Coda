<?php
/**
 * @var PDO $pdo
 */

require "./Model/persons.php";
const LIST_PERSONS_ITEM_PER_PAGE = 20;

if(!empty($_SERVER['CONTENT_TYPE']) &&
    ($_SERVER['CONTENT_TYPE'] === 'application/json' ||
        str_starts_with($_SERVER['CONTENT_TYPE'], 'application/x-www-form-urlencoded'))
) {
    if(isset($_GET['action']) && $_GET['action'] === 'number') {

    }
    $page = cleanCodeString($_GET['page']) ?? 1;
    [$persons, $count] = getAllPersons($pdo, LIST_PERSONS_ITEM_PER_PAGE, $page);
    if(!is_array($persons)){
        $errors[] = $persons;
    }
    header('Content-type: application/json');
    echo json_encode(['results' => $persons, 'count' => $count]);
    exit();
}

require "./View/persons.php";