<?php
require "Model/Login.php";

if (isset($_POST["login_button"])) {
  $username = !empty($_POST["username"]) ? $_POST["username"] : null;
  $pass = !empty($_POST["pass"]) ? $_POST["pass"] : null;


  if (
    !empty($username) &&
    !empty($pass)
  ) {
    $username = cleanString($username);
    $pass = cleanString($pass);

    $user = getUser($pdo, $username);

    $isMatchPassword = is_array($user) && password_verify($pass, $user["password"]);

    if ($isMatchPassword && $user['enabled']){
      $_SESSION["auth"] = true;
      header("location: index.php");
    }elseif (!$user['enabled']) {
      $errors[] = "votre compte est desactivé";
    }else {
      $error[] = "l'identification a echoué";
    }
  }

}

// if (isset($_POST["destroy"])) {

//   $_SESSION = [];

//   session_destroy();
//   if (session_status() === PHP_SESSION_NONE) {
//     header("View/users.php");
//     exit();
//   } else {
//     echo "Une session est toujours active.";
//   }
// }

require "View/login.php";

?>

