<?php

  //include "../templates/header.php";
  include "../../mvc/views/user-view.php";

  //    public function sendForm($token, $id, $username) {
  if (isset($_POST['submit'])) {

    $code = $_POST['code'];
    $token = $_POST['token'];
    $id = $_POST['id'];
    $username = $_POST['username'];
    $view = new user_view();

    $counter = 0;

    if ($code == $token) {

      session_start();
      $_SESSION['loggedin'] = true;
      $_SESSION['userId'] = $id;
      $_SESSION['userUId'] = $username;

      header("Location: ../../index.php?login=success_with_email");
      exit();
    }
    else {

      if ($counter < 3) {
        $view->sendForm($token, $id, $username);
        $counter++;

        echo "<br>Authentication code is incorrect.Try again.<br>";
        echo $token . "         " . $counter;
      }
      else {
        echo "too many tries";
      }

    }

  }







?>
