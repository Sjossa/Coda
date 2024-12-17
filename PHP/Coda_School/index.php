<?php
    session_start();
    require "Includes/database.php";
    require "Includes/function.php";
    $errors = [];
    if(isset($_GET["disconect"])) {
        session_destroy();
        header("Location: index.php");
        exit();
    }
    if(!empty($_SERVER['HTTP_X_REQUESTED_WIDTH']) &&
        $_SERVER['HTTP_X_REQUESTED_WIDTH'] === 'XMLHttpRequest'
    )
    {
        if(isset($_SESSION['auth'])) {
            if(isset($_GET["component"])){
                $componentName = cleanCodeString($_GET["component"]);
                if(file_exists("Controller/$componentName.php")){
                    require "Controller/$componentName.php";
                }
            } else {
                require "Controller/dashbord.php";
            }
        } else {
            require "Controller/login.php";
        }
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="Includes/fontawesome-free-6.7.1-web/css/all.min.css"/>
    <link href="Includes/bootstrap-5.3.3-dist/css/bootstrap.min.css" rel="stylesheet">
    <title>CODA_SCHOOL</title>
</head>
<body data-bs-theme="dark">
    <header>
    </header>
    <main>
        <div class="container">
            <?php
                if(isset($_SESSION['auth'])){
                    require "_partials/navbar.php";
                    if(isset($_GET["component"])){
                        $componentName = cleanCodeString($_GET["component"]);
                        if(file_exists("Controller/$componentName.php")){
                            require "Controller/$componentName.php";
                        }
                    } else {
                        require "Controller/dashbord.php";
                    }
                } else {
                    require "Controller/login.php";
                }
                require "_partials/errors.php";

            ?>
        </div>
        <?php require "_partials/_toast.html"?>
    </main>
    <footer>

    </footer>
    <script src="Includes/bootstrap-5.3.3-dist/js/bootstrap.js"></script>
</body>
</html>