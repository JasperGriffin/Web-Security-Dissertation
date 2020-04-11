<?php

  include "../templates/header.php";
  include "../../mvc/models/user-model.php";
  include "../../mvc/controllers/user-login-controller.php";

  if (isset($_SESSION['userId'])) {
    echo $_SESSION['userUId'];

    $id = $_SESSION['userId'];

    echo "
      <form action='password-reset.php' method='post'>
        <input type='submit' name='btnReset' value='Reset'/>
      </form>
    ";



    //$controller = new user_login_controller();
    //$login = $controller->getUsername();

  }
  else {
    die("You must be logged in");
  }
?>
