<?php

  include "../../mvc/models/user-model.php";
  include "../../mvc/controllers/user-login-controller.php";

  if (isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {

      header("Location: login.php?empty_fields");
      exit();
    }

    else {

      //store previous user page as $_GET and send along with usernamen nad password
      //https://stackoverflow.com/questions/14523468/redirecting-to-previous-page-after-login-

      $controller = new user_login_controller();
      $login = $controller->insecureLogin($username, $password);

    }
  }


 ?>
