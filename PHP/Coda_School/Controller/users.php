<?php
    /**
 * @var PDO $pdo
 */

    require "Model/users.php";


    if (
        isset($_GET['action']) &&
        isset($_GET['id']) &&
        is_numeric($_GET['id'])
        ) {
        $id = cleanString($_GET['id']);
        switch ($_GET['action']) {
            case 'toggle-enabled':
                toggleEnabled($pdo, $id);
                header("Location: index.php?component=users");
                break;
            case 'delete':

                $delete = delete($pdo, $id);

                if (!empty($delete))
                {
                    $delete = "Impossible de supprimer l'utilisateur car celui-ci est encore lié !";
                    $errors[] = $delete;
                } else {
                    header("Location: index.php?component=users");
                }

                break;
            default:
                break;
        }


    }

    $search = isset($_POST['search']) ? $_POST['search'] : null;
    $sortby = isset($_GET['sortby']) ? $_GET['sortby'] : null;
    $users = getAll($pdo, $search, $sortby);

    if (!is_array($users))
    {
        $errors[] = $users;
    }





    require "View/users.php";