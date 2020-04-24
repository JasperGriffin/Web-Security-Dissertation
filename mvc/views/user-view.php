<?php

  include_once "../../src/templates/header.php";

  class user_view {

    public function sendForm($token, $id, $username, $email, $ip, $timeStart, $counter) {

      echo "
        <form action='/src/session/twoFactorAuth.php' method='POST'>

          <input type='text' name='code'  placeholder='Enter code'><br>
          <input type='submit' name='submit' value='login'>

          <input type='hidden' name='token' value='$token'>
          <input type='hidden' name='id' value='$id'>
          <input type='hidden' name='username' value='$username'>
          <input type='hidden' name='email' value='$email'>
          <input type='hidden' name='ip' value='$ip'>
          <input type='hidden' name='timeStart' value='$timeStart'>
          <input type='hidden' name='counter' value='$counter'>

        </form>
      ";
    }

    public function sendMessage($token, $username, $ip) {

      $message = "
        <h2>Hi $username!</h2>
        <p>A sign in attempt of yours was registered from a different location (ip: $ip).
          To complete the sign in, enter the verfication code into the website.</p>
        <h2><b>$token</b></h2>
        <p>If you did not attempt to sign in, please immediately visit <a href='http://localhost/src/account/passwordReset.php'>
        http://localhost/src/account/passwordReset.php</a> to create a new, strong password</p>
        <p>Jasper Griffin</p>
      ";

      return $message;
    }

  }

?>
