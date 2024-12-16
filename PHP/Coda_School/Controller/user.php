<?php
/**
* @var PDO $pdo
 */
require "Model/user.php";

if(isset($_POST["modif_button"]) && empty($errors)){
    $username = !empty($_POST['name'])? $_POST['name'] : null;
    $email = !empty($_POST['mail'])? $_POST['mail'] : null;
    $password = !empty($_POST['pass'])? $_POST['pass'] : null;
    $cpass = !empty($_POST['cpassword'])? $_POST['cpassword'] : null;
    $enable = !empty($_POST['enable'])? true : false;

    $id = cleanCodeString($_GET['id']);
    if(!is_numeric($id)) {
        $errors[] = "ID non valide";
    }

    if($username != null && $email != null) {
        $username = cleanCodeString($username);
        $email = cleanCodeString($email);

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Email non valide";
        }

        $result = verif_email($pdo, $email, $id);

        if(!is_array($result)) {
            $errors[] = "Erreur de verifiaction de la BDD";
        } elseif ($result['usernb'] !== 0) {
            $errors[] = "l'email est déjà utiliser";
        }

        if(empty($errors)) {
            $result = update_name($pdo, $id, $username, $email, $enable);
            if(!empty($result)) {
                $errors[] = "Update impossible";
            }
        }
        if($password != null && $cpass != null && !empty($errors)) {
            $password = cleanCodeString($password);
            $cpass = cleanCodeString($cpass);

            if($password !== $cpass) {
                $errors[] = "Les mots de passe ne correspondent pas";
            } else {
                $cpass = null;
                $password = password_hash($password, PASSWORD_DEFAULT);

                $result = update_password($pdo, $id, $password);
                if(!empty($result)) {
                    $errors[] = "Update impossible";
                }
            }
        }
    }
}

if(isset($_GET['action']) && $_GET['action'] === 'edit'){
    $id = cleanCodeString($_GET['id']);
    if(!is_numeric($id)){
        $errors[] = "ID au mauvais format";
    } else {
        $user = getUser($pdo, $id);
        if(!is_array($user)){
            $errors[] = "Cet utilisateur n'existe pas";
        }
    }
}

if(isset($_POST['valid_button']) && empty($errors)){
    $username = !empty($_POST['name'])? $_POST['name'] : null;
    $email = !empty($_POST['mail'])? $_POST['mail'] : null;
    $password = !empty($_POST['pass'])? $_POST['pass'] : null;
    $cpass = !empty($_POST['cpassword'])? $_POST['cpassword'] : null;
    $enable = !empty($_POST['enable'])? true : false;


    if($username != null && $email != null && $password != null && $cpass != null) {
        $username = cleanCodeString($username);
        $email = cleanCodeString($email);
        $password = cleanCodeString($password);
        $cpass = cleanCodeString($cpass);


        if($password !== $cpass) {
            $errors[] = "Les mots de passe ne correspondent pas";
        } else {
            $cpass = null;
            $password = password_hash($password, PASSWORD_DEFAULT);
        }

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Email non valide";
        }

        if(empty($errors)) {
            $result = verif_email($pdo, $email);
            if(!is_array($result)) {
                $errors[] = "Erreur de verifiaction de la BDD";
            }
            if ($result['usernb'] !== 0) {
                $errors[] = "L'email est deja utiliser";
            }

            if(empty($errors)) {
                $result = new_user($pdo, $username, $email, $password, $enable);
                if(!empty($result)) {
                    $errors[] = "Création impossible";
                }
            }
        }
    } else {
        $errors[] = "Veillez remplir tous les champs";
    }
}

require "View/user.php";