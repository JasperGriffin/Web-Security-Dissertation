<?php

  include "../../mvc/models/user-model.php";
  include "../../mvc/controllers/user-login-controller.php";
  include_once "sessionHandling.php";

  if (isset($_POST['submit'])) {

    $code = $_POST['code'];
    $token = $_POST['token'];
    $id = $_POST['id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $ip = $_POST['ip'];
    $timeStart = $_POST['timeStart'];
    $counter = $_POST['counter'];

    $controller = new user_login_controller();
    $view = new user_view();
    $timeEnd = time();

    $difference = $timeEnd - $timeStart;

    //difference -> token experiened
    //counter -> counter put in too many times -> send

    //600 = 10 minutes
    if ($difference > 600) {

      $twoFactorAuth = $controller->setTwoFactorAuth($id, $username, $email, $ip);
      echo "Session timeout";
    }
    else if ($counter > 3) {

      echo "Max submission reached <br>";
      $twoFactorAuth = $controller->setTwoFactorAuth($id, $username, $email, $ip);
      echo "Generated a new token";

    }
    else if ($code == $token) {

      $session = new sessionHandling($id, $username);
      $session->setWeakSession($id, $username);
    }
    else {

      echo "incorrect login <br> $counter";
      $counter++;
      $view->sendForm($token, $id, $username, $email, $ip, $timeStart, $counter);
    }

  }







?>
