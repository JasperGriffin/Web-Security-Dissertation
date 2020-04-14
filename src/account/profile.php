<?php

  //include "../templates/header.php";
  include "../../mvc/models/user-model.php";
  include "../../mvc/controllers/user-login-controller.php";

  if (isset($_SESSION['userId'])) {
    echo $_SESSION['userUId'];

    $id = $_SESSION['userId'];

    //through view model
    echo "
      <form action='password-reset.php' method='post'>
        <input type='submit' name='btnReset' value='Reset'/>
      </form>
    ";

    //if (isset($_POST['form-submit'])) {}

  }
  else {
    die("You must be logged in");
  }
?>
