<?php

  include "../../mvc/models/user-model.php";
  include "../../mvc/controllers/user-controller.php";

  if (isset($_POST['signup'])) {

    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $repeatPassword = $_POST['repeat-password'];

    $controller = new user_controller();
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

    //check that validates username under certain characters
    //future case: force users to have [A-z][1-9] to increase complexity
    else if (!preg_match('/^[A-z0-9]{5,20}/', $username)) {
      header("Location: http://localhost/src/account/signup.php?error=invalid_username");
      exit();
    }

    //check that username hasn't been taken
    else if ($check) {
      header("Location: http://localhost/src/account/signup.php?error=duplicate_username");
      exit();
    }
    //check that passwords match
    else if ($password !== $repeatPassword) {
      header("Location: http://localhost/src/account/signup.php?error=passwords_mismatch");
    }

    //when all checks are passed, store in db through user-controller
    else {

      $ip = $_SERVER['REMOTE_ADDR'];
      $dateCreated = date("Y-m-d");
      $lastLogin = date("Y-m-d");

      $signup = $controller->insecureSignup($email, $username, $password, $repeatPassword, $ip, $dateCreated, $lastLogin);
    }
  }


?>
