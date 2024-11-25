<?php

if (isset($_POST['valid'])) {
    // if ( isset( $_POST['username'] ) ) {
    //     $username = $_POST['username'];
    // }

    $username = !empty($_POST['username']) ? $_POST['username'] : null;
    $pass = !empty($_POST['pass']) ? $_POST['pass'] : null;

    if (
        $username !== null &&
        $pass !== null &&
        filter_var($username, FILTER_VALIDATE_EMAIL)
    ) {


    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Mon formulaire</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <form method="post">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">identifiant</label>
                <input type="email" class="form-control" name="username" id="username" required>
            </div>

            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">mot de passe</label>
                <input type="password" class="form-control" id="pass" name="pass" required>
            </div>

            <button type="submit" class="btn btn-primary" name="valid">valider</button>

        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>



</html>
