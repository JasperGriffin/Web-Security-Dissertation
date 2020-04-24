<?php

class sessionHandling {

  //public function __construct($id, $username) {}

  /*SESSION VIOLATION: session is meaningful as it's set equal to the consecutive user id*/
  /*Can either steal a user's session id by either in the URL or in the browser cookies*/
  /*Additionally, session isn't regenerated with each login*/
  public function setMeaningfulSession($id, $username) {

    //session_regenerate_id(TRUE);

    /*session_id($id);
    session_start();

    $_SESSION['loggedin'] = true;
    $_SESSION['userId'] = $id;
    $_SESSION['userUId'] = $username;

    //header("Location: ../../index.php?user_id=$id");*/
  }

  /*SESSION VIOLATION: session has small */
  public function setWeakSession($id, $username) {

    //come up with number generation
    //2^(b+1) / (2 * A * S)
    //Where b = no of bits of entropy, a = no of guesses per sec, s = no of valid tokens

    /*$range = "1234567890";
    $array = array();

    $rangeLength = strlen($range) - 1;

    for ($i = 0; $i < 10; $i++) {
      $rand = rand(0, $rangeLength);
      $array[] = $range[$rand];
    }

    $token = implode($array);*/
    $id = "1234567899";
    header("Location: ../../index.php?token=$id");
    exit();
  }

  public function setAdminSession() {

    session_regenerate_id(TRUE);
    $_SESSION['MAX_AUTH_LEVEL'] = true;
    header("Location: ../../index.php?login_success");
    exit();
   }

  public function setSecureSession() {

    session_regenerate_id(TRUE);
    header("Location: ../../index.php?login_success");
    exit();
  }

}

?>
