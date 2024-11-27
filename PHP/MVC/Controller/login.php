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

    if ($isMatchPassword) {
      $_SESSION["auth"] = true;
    } else {
      $error[] = "l'identification a echoué";
    }
  }

}
require "View/login.php";

?>

