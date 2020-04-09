<?php

  include "../../mvc/models/user-model.php";
  include "../../mvc/controllers/user-controller.php";

  if (isset($_GET['login'])) {

    $username = $_GET['username'];
    $password = $_GET['password'];

    if (empty($username) || empty($password)) {

      header("Location: http://localhost/src/account/login.php");
      exit();
    }
    else {

      //store previous user page as $_GET and send along with usernamen nad password
      //https://stackoverflow.com/questions/14523468/redirecting-to-previous-page-after-login-php

      $controller = new user_controller();
      $login = $controller->login($username, $password);

    }
  }


 ?>
