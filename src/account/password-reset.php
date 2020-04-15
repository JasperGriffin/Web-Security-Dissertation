<?php

  if (isset($_POST['btnReset'])) {

    //$controller = new user_login_controller();
    //$passwordReset = $controller->passwordReset();

    $username = $_POST['username'];
  }
?>

<html>
  <head>
    <title>Password Reset</title>
  </head>
  <body>
    <form action="verifyPasswordReset.php" method="POST">

      <label for="Password">New password:</label>
      <input type="text" name="password" placeholder="New password..."><br>

      <label for"RepeatPassword">Repeat Password:</label>
      <input type="text" name="repeatpassword" placeholder="Repeat password..."><br>

      <input type="submit" name="submit" value="submit">

    </form>
  </body>
</html>
