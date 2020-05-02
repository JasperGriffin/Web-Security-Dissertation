<?php

  require_once "../templates/header.php";

  if (!isset($_SESSION['userId'])) {
    die ("You must be logged in to reset your password");
  }
  
?>

<html>
  <head>
    <title>Password Reset</title>
    <link rel="stylesheet" type="text/css" href="/public/assets/css/login.css">

  </head>
  <body>

    <div class="hr-container">
      <hr width="80%">

      <div class="login-container">

        <h1>Password reset</h1>
        <h2>Enter your new password which will automatically replace your old one</h2>

        <?php

          $url = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

          if (strpos($url, "empty_fields") == true) {
            echo "<p class='error'>Please fill in all fields</p><br>";
          }
          else if (strpos($url, "passwords_dont_match") == true) {
            echo "<p class='error'>Passwords don't match</p><br>";
          }
          else if (strpos($url, "unknown_error") == true) {
            echo "<p class='error'>An error has occured. A valid password must only contain a few special symbols (!, ?, $)</p>";
          }
          else if (strpos($url, "connection_error") == true) {
            echo "<p class='error'>There's a problem connecting to servers at the moment<br>Try again later</p>";
          }
        ?>

        <div class="form-container">
          <form action="verifyPasswordReset.php" method="POST">

            <input id="password" type="text" name="password" placeholder="New password"><br>

            <input id="password" type="text" name="repeatPassword" placeholder="Repeat password"><br>

            <input id="login" type="submit" name="submit" value="Reset my password">

          </form>
        </div>
      </div>
        <hr width="80%">
      </div>
    </body>
</html>


<?php

  include_once "../templates/footer.php";

?>
