<?php

  //include "../templates/header.php";
  include "../../mvc/models/user-model.php";
  include "../../mvc/controllers/user-login-controller.php";

  if (isset($_SESSION['userId'])) {

    $username = $_SESSION['userUId'];
    $id = $_SESSION['userId'];


    //if (isset($_POST['form-submit'])) {}

  }
  else {
    die("You must be logged in");



  }
?>

<html>
  <head>
    <title>Profile</title>
  </head>
  <body>
    <form action='password-reset.php' method='post'>
      <button type="submit">Password reset</button>
    </form>
  </body>
</html>
