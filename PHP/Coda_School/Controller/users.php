<?php
/**
 * @var PDO $pdo
 */

require "Model/users.php";

if(
    isset($_GET['action']) &&
    $_GET['action'] === 'delete' &&
    isset($_GET['id']) &&
    is_numeric($_GET['id']))
{
    $id = cleanCodeString($_GET['id']);
    $deleted = delete_user($pdo, $id);
    if(!empty($deleted)) {
        $errors[] = $deleted;
    } else {
        header("Location: index.php?component=users");
    }

}

$search = isset($_POST['search']) ? cleanCodeString($_POST['search']) : null;
$sortby = isset($_GET['sortby']) ? cleanCodeString($_GET['sortby']) : null;
//$sens = isset($_GET['sens']) ? cleanCodeString($_GET['sens']) : null;
//$sens = $sens === 'asc' ? 'desc' : 'asc';
$users = getAll($pdo, $search, $sortby);
if(!is_array($users)) {
    $errors[] = $users;
}
if(!empty($_SERVER['HTTP_X_REQUESTED_WIDTH']) &&
    $_SERVER['HTTP_X_REQUESTED_WIDTH'] === 'XMLHttpRequest'
) {
    if(
        isset($_GET['action']) &&
        $_GET['action'] === 'toogle_enabled' &&
        isset($_GET['id']) &&
        is_numeric($_GET['id'])
    ) {
        $id = cleanCodeString($_GET['id']);
        $response = toogle_enabled($pdo, intval($id));
        header("Content-Type: application/json");
        if(is_bool($response)) {
            echo json_encode(['success' => true]);
            exit();
        } else {
            echo json_encode(['error' => $response]);
            exit();
        }
    }
}
require "View/users.php";

