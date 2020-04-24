<?php

  include "../../mvc/models/user-model.php";
  include "../../mvc/controllers/user-login-controller.php";

  if (isset($_POST['submit'])) {

    $password = $_POST['password'];
    $repeatPassword = $_POST['repeatPassword'];

    if (empty($password) || empty($repeatPassword)) {
      header("Location: passwordReset.php?empty_fields");
      exit();
    }
    else if ($password != $repeatPassword) {
      header("Location: passwordReset.php?passwords_dont_match");
      exit();
    }
    else if ($password == $repeatPassword) {

      $controller = new user_login_controller();
      $passwordReset = $controller->passwordReset($password);
    }

  }

?>
