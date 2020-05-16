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
    /*
    //check that validates username under certain characters (input validation)
    else if (!preg_match('/^(?:.*[A-z0-9]{8,20}|)$/', $username)) {
      header("Location: http://localhost/src/account/login.php?error=invalid_username");
      exit();
    }
    //password must contain an upper case letter and must be above 8 letters
    else if (!preg_match('/(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[!?<>:@+£$%^&*()~#`¬{};_])[A-Za-z\d\!?<>:@+£$%^&*()~#`¬{};_]{8,}$/', $password)) {
      header("Location: http://localhost/src/account/signup.php?error=invalid_password");
      exit();
    }*/
    else {

      //store previous user page as $_GET and send along with usernamen nad password
      //https://stackoverflow.com/questions/14523468/redirecting-to-previous-page-after-login-

      $controller = new user_login_controller();
      $login = $controller->secureLogin($username, $password);

    }
  }


 ?>
