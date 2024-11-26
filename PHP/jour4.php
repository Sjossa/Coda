<?php
require "jour3_functions.php";
$errors = [];
try {
    $pdo = new PDO('mysql:host=localhost;dbname=coda_school', 'root');
} catch (Exception $e) {
    $errors[] = "Erreur de connexion à la bdd {$e->getMessage()}";
}
if (isset($_GET["id"])) {
    $id = $_GET['id'];
    if (!is_numeric($id)) {

        $errors[] = "id au mauvais format";

    } else {

    }
}
if (isset($_POST['valid_button'])) {
    $errors = [];
    $username = !empty($_POST['username']) ? $_POST['username'] : null;
    $password = !empty($_POST['pass']) ? $_POST['pass'] : null;
    $confirmation = !empty($_POST['confirmation']) ? $_POST['confirmation'] : null;
    $email = !empty($_POST['email']) ? $_POST['email'] : null;
    $enabled = !empty($_POST['enabled']) ? true : false;

    if (
        !empty($username) &&
        !empty($email) &&
        !empty($password) &&
        !empty($confirmation)
    ) {
        $username = cleanString($username);
        $email = cleanString($email);
        $password = cleanString($password);
        $confirmation = cleanString($confirmation);

        if ($confirmation !== $password) {
            $errors[] = 'Le mot de passe et sa confirmation sont différents';
        } else {
            $confirmation = null;
            $password = password_hash($password, PASSWORD_DEFAULT);
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'email invalide';
        }



        if (empty($errors)) {

            try {
                $state = $pdo->prepare("SELECT COUNT(*) AS user_number FROM users WHERE username = :username");
                $state->bindParam(':username', $username, PDO::PARAM_STR);
                $state->execute();
                $res = $state->fetch();
            } catch (Exception $e) {
                $errors[] = "Erreur de verification du username {$e->getMessage()}";
            }

            if ($res['user_number'] !== 0) {
                $errors[] = 'Le username est déjà utilisé';
            }

            try {
                $state = $pdo->prepare('INSERT INTO users (`username`, `email`, `password`, `enabled`)
                    VALUES (:username, :email, :password, :enabled)');
                $state->bindParam(':username', $username);
                $state->bindParam(':email', $email);
                $state->bindParam(':password', $password);
                $state->bindParam(':enabled', $enabled, PDO::PARAM_BOOL);
                $state->execute();
            } catch (Exception $e) {
                $errors[] = "Erreur à la création du user {$e->getMessage()}";
            }
        }
    } else {
        $errors[] = 'Tous les champs sont obligatoires';
    }


}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Mon formulaire</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <?php if (!empty($errors)): ?>
            <?php foreach ($errors as $error): ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $error; ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
        <form method="post">
            <div class="mb-3">
                <label for="username" class="form-label">Identifiant</label>
                <input type="text" name="username" id="username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="pass" class="form-label">Mot de passe</label>
                <input type="password" name="pass" id="pass" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="confirmation" class="form-label">Confirmation du mot de passe</label>
                <input type="password" name="confirmation" id="confirmation" class="form-control" required>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="enabled" name="enabled">
                <label class="form-check-label" for="enabled">Actif</label>
            </div>
            <div class="mb-3 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary" name="valid_button">Enregistrer</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>
