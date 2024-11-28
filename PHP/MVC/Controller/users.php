<?php
require "Model/users.php";

/**
 * @var PDO $pdo
 */

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





$users = getAll($pdo);





require "View/users.php";

?>

