<?php

  require_once "../templates/header.php";

  if (!isset($_SESSION['userId'])) {
    die ("You must be logged in to reset your password");
  }

  $url = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

  if (strpos($url, "empty_fields") == true) {
    echo "<p>Please fill in all fields</p><br>";
  }
  else if (strpos($url, "passwords_dont_match") == true) {
    echo "<p>Passwords don't match</p><br>";
  }
  else if (strpos($url, "unknown_error") == true) {
    echo "<p>An error has occured. A valid password must only contain a few special symbols (!, ?, $)</p>";
  }
  else if (strpos($url, "connection_error") == true) {
    echo "<p>There's a problem connecting to servers at the moment<br>Try again later</p>";
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
      <input type="text" name="repeatPassword" placeholder="Repeat password..."><br>

      <input type="submit" name="submit" value="submit">

    </form>
  </body>
</html>
