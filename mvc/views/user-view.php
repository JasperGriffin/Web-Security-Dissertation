<?php

  include "../../src/templates/header.php";

  class user_view {

    public function sendForm($token, $id, $username) {

      echo "
        <form action='twoFactorAuth.php' method='POST'>
          <input type='text' name='code'  placeholder='Enter code'><br>
          <input type='submit' name='submit' value='login'>
          <input type='hidden' name='token' value='$token'>
          <input type='hidden' name='id' value='$id'>
          <input type='hidden' name='username' value='$username'>
        </form>
      ";
    }

  }

?>
