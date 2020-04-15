<?php

  include_once "../../src/templates/header.php";

  class user_view {

    //$view->sendForm($token, $id, $username, $email, $timeStart, $counter);
    public function sendForm($token, $id, $username, $email, $timeStart, $counter) {

      echo "
        <form action='twoFactorAuth.php' method='POST'>
        
          <input type='text' name='code'  placeholder='Enter code'><br>
          <input type='submit' name='submit' value='login'>

          <input type='hidden' name='token' value='$token'>
          <input type='hidden' name='id' value='$id'>
          <input type='hidden' name='username' value='$username'>
          <input type='hidden' name='email' value='$email'>
          <input type='hidden' name='timeStart' value='$timeStart'>
          <input type='hidden' name='counter' value='$counter'>

        </form>
      ";
    }

  }

?>
