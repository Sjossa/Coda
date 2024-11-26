<?php
require "jour3_functions.php";

if (isset($_POST['confirmer'])) {

    $username = !empty($_POST['username']) ? ($_POST['username']) : null;
    $password = !empty($_POST['password']) ? ($_POST['password']) : null;
    $email = !empty($_POST['email']) ? ($_POST['email']) : null;
    $confirmation = !empty($_POST['confirmation']) ? ($_POST['confirmation']) : null;
    $active = isset($_POST['active']) ? 1 : 0;
    $error_messages = [];


    if ($username === null) {
        $error_messages[] = "Le champ 'Nom d'utilisateur' est obligatoire.";
    }
    if ($password === null) {
        $error_messages[] = "Le champ 'Mot de passe' est obligatoire.";
    }
    if ($confirmation === null) {
        $error_messages[] = "Le champ 'Confirmation du mot de passe' est obligatoire.";
    }
    if ($email === null) {
        $error_messages[] = "Le champ 'Adresse e-mail' est obligatoire.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_messages[] = "L'adresse e-mail est invalide.";
    }
    if ($password !== $confirmation) {
        $error_messages[] = "Les mots de passe ne correspondent pas.";
    }


    if (!empty($error_messages)) {
        foreach ($error_messages as $message) {
            echo '<div class="alert alert-danger mt-3">' . htmlspecialchars($message) . '</div>';
        }
    } else {
        try {
            $pdo = new PDO('mysql:host=localhost;dbname=coda_school', 'root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Hashage du mot de passe
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);

            // Requête préparée
            $sql = "INSERT INTO users (username, password, email, enable) VALUES (:username, :password, :email, :active)";
            $stmt = $pdo->prepare($sql);

            // Liaison des paramètres
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $hashed_password);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':enable', $active, PDO::PARAM_INT);


            // Exécution de la requête
            $stmt->execute();
            echo '<div class="alert alert-success mt-3">Utilisateur ajouté avec succès !</div>';
        } catch (PDOException $e) {
            echo '<div class="alert alert-danger mt-3">Erreur lors de l\'insertion : ' . htmlspecialchars($e->getMessage()) . '</div>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon formulaire</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <form method="post">
            <div class="mb-3">
                <label for="username" class="form-label">Nom d'utilisateur</label>
                <input type="text" name="username" id="username" class="form-control"
                    placeholder="Entrez votre nom d'utilisateur">
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" name="password" id="password" class="form-control"
                    placeholder="Entrez votre mot de passe" required>
            </div>

            <div class="mb-3">
                <label for="confirmation" class="form-label">Confirmation du mot de passe</label>
                <input type="password" name="confirmation" id="confirmation" class="form-control"
                    placeholder="Confirmez votre mot de passe" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Adresse e-mail</label>
                <input type="email" name="email" id="email" class="form-control"
                    placeholder="Entrez votre adresse e-mail">
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" name="active" id="active" class="form-check-input">
                <label for="active" class="form-check-label">Compte actif</label>
            </div>

            <button type="submit" name="confirmer" class="btn btn-primary">Confirmer</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>
