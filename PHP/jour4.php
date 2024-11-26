<?php
require "jour3_functions.php";
    $error = [];
    try {
        $pdo = new PDO("mysql:host=localhost;dbname=coda_school", "root");
    } catch (Exception $e) {
        $error[] = "Erreur de connexion a la BDD{$e->getMessage()}";
    }

    if(isset($_POST["modif_button"]) && empty($error)) {
        $username = !empty($_POST['name'])? $_POST['name'] : null;
        $email = !empty($_POST['mail'])? $_POST['mail'] : null;
        $password = !empty($_POST['pass'])? $_POST['pass'] : null;
        $cpass = !empty($_POST['cpassword'])? $_POST['cpassword'] : null;
        $enable = !empty($_POST['enable'])? true : false;

        $id = $_GET["id"];
        if(!is_numeric($id)){
            $error[] = "ID au mauvais format";
        }

        if(
            $username != null &&
            $email != null
            ) {

            $username = cleanString($username);
            $email = cleanString($email);




            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error[] = "L'email n'est pas valide";
            }


            try {
                $state = $pdo->prepare("SELECT COUNT(*) AS usernb FROM `users` WHERE `email` = :mail");
                $state->bindParam(':mail', $email);
                $state->execute();
                $result = $state->fetch();
            } catch (Exception $e) {
                $error[] = " Erreur de verifiaction de la BDD{$e->getMessage()}";
            }

            if($result['usernb'] !== 0){
                $error[] = "l'email est déjà utiliser";
            }

            if(empty($error)) {
                try {
                    $statement = $pdo->prepare("UPDATE `users` SET username = :username, email = :email, enabled = :enabled WHERE id = :id");
                    $statement->bindParam(":username", $username);
                    $statement->bindParam(":email", $email);
                    $statement->bindParam(":enabled", $enable, PDO::PARAM_BOOL);
                    $statement->bindParam(":id", $id, PDO::PARAM_INT);
                    $statement->execute();
                } catch (Exception $e) {
                    $error[] = "Erreur de requête : {$e->getMessage()}";
                }
            }

        }
    }
    if(
        !empty($password) &&
        !empty($cpass)
    ){
        $password = cleanCodeString($password);
            $cpass = cleanCodeString($cpass);

            if ($password !== $cpass) {
                $error[] = "Les mots de passe ne correspondent pas";
            } else {
                $cpass = null;
                $password = password_hash($password, PASSWORD_DEFAULT);

                try {
                    $statement = $pdo->prepare("UPDATE `users` SET password = :password  WHERE id = :id");
                    $statement->bindParam(":id", $id, PDO::PARAM_INT);
                    $state->bindParam(':password', $password);
                    $statement->execute();
                } catch (Exception $e) {
                    $error[] = "Erreur de requête : {$e->getMessage()}";
                }
            }



    }

    if(isset($_GET["id"]) && empty($error)) {
        $id = $_GET["id"];
        if(!is_numeric($id)){
            $error[] = "ID au mauvais format";
        } else {
            try {
                $statement = $pdo->prepare("SELECT `username`, `email`, `enabled` FROM `users` WHERE id = :id");
                $statement->bindParam(":id", $id, PDO::PARAM_INT);
                $statement->execute();
                $user = $statement->fetch();
            } catch (Exception $e) {
                $error[] = "Erreur de requête : {$e->getMessage()}";
            }
        }
    }

    if(isset($_POST['valid_button']) && empty($error)) {

        $username = !empty($_POST['name'])? $_POST['name'] : null;
        $email = !empty($_POST['mail'])? $_POST['mail'] : null;
        $password = !empty($_POST['pass'])? $_POST['pass'] : null;
        $cpass = !empty($_POST['cpassword'])? $_POST['cpassword'] : null;
        $enable = !empty($_POST['enable'])? true : false;

        if($username != null &&
            $email != null &&
            $password != null &&
            $cpass != null)
        {
            $username = cleanString($username);
            $email = cleanString($email);
            $password = cleanString($password);
            $cpass = cleanString($cpass);

            if($password !== $cpass){
                $error[] = "Les mots de passe ne correspondent pas";
            } else {
                $cpass = null;
                $password = password_hash($password, PASSWORD_DEFAULT);
            }

            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $error[] = "L'email n'est pas valide";
            }

            if(empty($error)) {
                try {
                    $state = $pdo->prepare("SELECT COUNT(*) AS usernb FROM `users` WHERE `email` = :mail");
                    $state->bindParam(':mail', $email);
                    $state->execute();
                    $result = $state->fetch();
                } catch (Exception $e) {
                    $error[] = " Erreur de verifiaction de la BDD{$e->getMessage()}";
                }

                if($result['usernb'] !== 0){
                    $error[] = "l'email est déjà utiliser";
                }

                try {
                    $state = $pdo->prepare("INSERT INTO `users`(`username`, `password`, `email`, `enabled`)
                    VALUES (:username, :password, :mail, :enable)");
                    $state->bindValue(':username', $username);
                    $state->bindValue(':password', $password);
                    $state->bindValue(':mail', $email);
                    $state->bindValue(':enable', $enable, PDO::PARAM_BOOL);
                    $state->execute();
                } catch (Exception $e) {
                    $error[] = " Erreur a la creation du user dans la BDD{$e->getMessage()}";
                }

            }

        } else {
            $error[] = "Veuillez remplir tous les champs";
        }
    }

?>

<html lang="fr">
<head>
    <title>Test de formulaire</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
<div class="container col-4">
    <?php if(!empty($error)): ?>
        <?php foreach($error as $value): ?>
            <div class="alert alert-danger mt-2" role="alert">
                <?php echo $value; ?>
            </div>
        <?php endforeach;?>
    <?php endif;?>
</div>

<h1 class="text-center"><?php echo isset($_GET['id']) ? "Modification" : "Inscription";?></h1>
<div class="container col-4">
    <form method="post">
        <div class="mb-3">
            <label for="name "class="form-label">Username</label>
            <input type="text" name="name" class="form-control" value="<?php echo isset($user['username']) ? $user['username'] : ''?>" required>
        </div>
        <div class="mb-3">
            <label for="mail" class="form-label">Email</label>
            <input type="email" name="mail" class="form-control" value="<?php echo isset($user['email']) ? $user['email'] : ''?>" required>
        </div>
        <div class="mb-3">
            <p>Les espaces sont interdit</p>
            <label for="pass" class="form-label">Password</label>
            <input type="password" class="form-control" id="pass" name="pass" <?php echo isset($_GET['id']) ? null : 'required'; ?>>
        </div>
        <div class="mb-3">
            <label for="cpassword" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" id="pass" name="cpassword" <?php echo isset($_GET['id']) ? null : 'required'; ?>>
        </div>
        <div class="mb-3 form-check">
            <label for="enable" class="form-check-label">Enable</label>
            <input
                    type="checkbox"
                    class="form-check-input"
                    id="enable"
                    name="enable"
                <?php echo isset($user['enabled']) && $user['enabled'] ? 'checked' : null; ?>>
        </div>
        <button
                type="submit"
                class="btn  <?php echo isset($_GET['id']) ? 'btn-success' : 'btn-primary'; ?>"
                name="<?php echo isset($_GET['id']) ? 'modif_button' : 'valid_button';?>">
            <?php echo isset($_GET['id']) ? 'Editer' : 'Crée';?>
        </button>
    </form>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
