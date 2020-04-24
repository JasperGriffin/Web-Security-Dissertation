<?php

  include "../../mvc/models/user-model.php";
  include "../../mvc/controllers/user-login-controller.php";

  if (!isset($_SESSION['userId'])) {
    die("You must be logged in");
  }

  $url = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

  if (strpos($url, "password_reset") == true) {
    echo "<p>Password reset successfully</p><br>";
  }

?>

<html>
  <head>
    <title>Profile</title>
  </head>
  <body>
    <h1>Username: <?php echo"$_SESSION[userUId]"  ?></h1>
    <h1>Session: <?php echo session_id()  ?></h1>
    <form action='passwordReset.php' method='post'>
      <button type="submit">Password reset</button>
    </form>
  </body>
</html>
