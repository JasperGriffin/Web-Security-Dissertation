<?php

  include "../../mvc/models/user-model.php";
  include "../../mvc/controllers/user-signup-controller.php";

  if (isset($_POST['signup'])) {

    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $repeatPassword = $_POST['repeat-password'];

    $controller = new user_signup_controller();
    $check = $controller->checkUsername($username);

    //check if any fields are empty
    if (empty($email) || empty($username) || empty($password) || empty($repeatPassword)) {
      header("Location: http://localhost/src/account/signup.php?error=emptyfield");
      exit();
    }

    //check that validates email
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      header("Location: http://localhost/src/account/signup.php?error=invalid_email");
      exit();
    }

    //check that validates username under certain characters (input validation)
    //future case: force users to have [A-z][1-9]* to increase complexity
    else if (!preg_match('/^(?:.*[A-z0-9]{4,20}|)$/', $username)) {
      header("Location: http://localhost/src/account/signup.php?error=invalid_username");
      exit();
    }

    //check that username hasn't been taken
    else if ($check) {
      header("Location: http://localhost/src/account/signup.php?error=duplicate_username");
      exit();
    }

    //check that passwords match
    else if ($password != $repeatPassword) {
      header("Location: http://localhost/src/account/signup.php?error=passwords_mismatch");
      exit();
    }

    //password must contain an upper case letter and must be above 8 letters
    else if (!preg_match('/(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[!?<>:@+£$%^&*()~#`¬{};_])[A-Za-z\d\!?<>:@+£$%^&*()~#`¬{};_]{8,}$/', $password)) {
      header("Location: http://localhost/src/account/signup.php?error=invalid_password");
      exit();
    }

    //when all checks are passed, store in db through user-controller
    else {

      $ip = $_SERVER['REMOTE_ADDR'];
      $dateCreated = date("Y-m-d");
      $lastLogin = date("Y-m-d");

      //$username = mysqli_real_escape_string($username);

      //store as array, too many parameters
      $userCredentials = array($username, $password, $email, $ip, $dateCreated, $lastLogin);

      $signup = $controller->secureSignup($userCredentials);
    }
  }


?>
