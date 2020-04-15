<?php


  //include "../../mvc/views/user-view.php";
  include "../../mvc/models/user-model.php";
  include "../../mvc/controllers/user-login-controller.php";

  if (isset($_POST['submit'])) {

    $code = $_POST['code'];
    $token = $_POST['token'];
    $id = $_POST['id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $timeStart = $_POST['timeStart'];
    $counter = $_POST['counter'];

    $view2 = new user_view();
    $timeEnd = time();

    $difference = $timeEnd - $timeStart;


    //difference -> token experiened
    //counter -> counter put in too many times -> send

    if ($difference > 50) {

      $controller = new user_login_controller();
      $twoFactorAuth = $controller->setTwoFactorAuth($id, $username, $email);
      echo "Session timeout";
    }
    else if ($counter > 3) {
      echo "Max submission reached <br>";
      $controller = new user_login_controller();
      $twoFactorAuth = $controller->setTwoFactorAuth($id, $username, $email);
      echo "Generated a new token";

    }
    else if ($code == $token) {
      session_start();
      $_SESSION['loggedin'] = true;
      $_SESSION['userId'] = $id;
      $_SESSION['userUId'] = $username;

      header("Location: ../../index.php?login=success_with_email_difference=_$difference");
      exit();
    }
    else {

      echo "incorrect login <br> $counter";
      $counter++;
      $view2->sendForm($token, $id, $username, $email, $timeStart, $counter);
    }


  }







?>
