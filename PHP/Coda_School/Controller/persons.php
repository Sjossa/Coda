<?php
/**
 * @var PDO $pdo
 */

require "./Model/persons.php";
const LIST_PERSONS_ITEM_PER_PAGE = 20;

if(!empty($_SERVER['HTTP_X_REQUESTED_WIDTH']) &&
    $_SERVER['HTTP_X_REQUESTED_WIDTH'] === 'XMLHttpRequest'
) {
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