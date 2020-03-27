<?php

  include "../../mvc/models/user-model.php";
  include "../../mvc/controllers/user-controller.php";

  $username = $_GET['username'];
  $password = $_GET['password'];

  if (empty($username) || empty($password)) {

    header("Location: http://localhost/src/account/login.php");
    exit();
  }
  else {

    $controller = new user_controller();
    $data = $controller->insecureLogin($username, $password);

  }
 ?>
