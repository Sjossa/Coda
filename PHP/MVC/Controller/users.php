<?php
require "Model/users.php";

/**
 * @var PDO $pdo
 */

// if (isset($_POST['search'])) {

// }

if (
  isset($_GET['action']) &&
  $_GET['action'] === 'toggle_enabled' &&
  isset($_GET['id']) &&
  is_numeric($_GET['id'])
) {
  $id = cleanString($_GET['id']);
  toggle_enabled($pdo, $id);
  header('Location: index.php?component=users');
}

if (
  isset($_GET['action']) &&
  $_GET['action'] === 'delete' &&
  isset($_GET['id']) &&
  is_numeric($_GET['id'])
) {

  $id = cleanString($_GET['id']);

  switch ($_GET['action']) {
    case 'toggle_enabled':
      toggle_enabled($pdo, $id);
      header('Location: index.php?component=users');
      break;
    case 'delete';
      $deleted = deleteUser($pdo, $id);
      if (!empty($deleted)) {
        $errors = $deleted;
      } else {
        header('Location: index.php?componenet=users');
      }
      break;
  }
}
$search = isset($_POST['search']) ? cleanString($_POST['search']) : null;
$sortBy = isset($_GET['sortby']) ? cleanString($_GET['sortby']) : null;

$users = getAll($pdo, $search, $sortBy);
if(!array($users)){
  $errors[] = $user;
}


require "View/users.php";

?>

