<?php
/**
 * @var PDO $pdo
 */
require "Model/login.php";

if(!empty($_SERVER['HTTP_X_REQUESTED_WIDTH']) &&
    $_SERVER['HTTP_X_REQUESTED_WIDTH'] === 'XMLHttpRequest'
) {
    $username = !empty($_POST['username']) ? $_POST['username'] : null;
    $password = !empty($_POST['password']) ? $_POST['password'] : null;

    if($username !== null && $password !== null && filter_var($username, FILTER_VALIDATE_EMAIL)){
        $username = cleanCodeString($username);
        $password = cleanCodeString($password);

        $user = getUser($username, $pdo);
        if(is_array($user)){
            $isMatchPassword = is_array($user) && password_verify($password, $user['password']); //ou en version classique avec un if

            if($isMatchPassword && $user['enabled'] && is_array($user)){
                $_SESSION['auth'] = true;
                $_SESSION['username'] = $user['username'];
                $_SESSION['userId'] = $user['id'];
                header("Content-type: application/json");
                echo json_encode(['authentication' => true]);
                exit();
            } elseif (!$user['enabled'] && $isMatchPassword && is_array($user)){
                $errors[] = "Votre compte est desactivé";
            } else {
                $errors[] = "Authentification invalide";
            }
        } else {
            $errors[] = "Utilisateur invalide";
        }
    }

    if(!empty($errors)){
        header("Content-type: application/json");
        echo json_encode(['errors' => $errors]);
        exit();
    }
}

require "View/login.php";