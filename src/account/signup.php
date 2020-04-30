<?php

  include "../templates/header.php";

  $url = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

  if (strpos($url, "error=emptyfield") == true) {
    echo "<p>Please fill in all the fields</p>";
  }
  else if (strpos($url, "error=invalid_email") == true) {
    echo "<p>Email address is not valid</p>";
  }
  else if (strpos($url, "error=invalid_username") == true) {
    echo "<p>Username must have no special symbols (!, $, #)</p>";
  }
  else if (strpos($url, "error=duplicate_username") == true) {
    echo "<p>Username already exists</p>";
  }
  else if (strpos($url, "error=passwords_mismatch") == true) {
    echo "<p>Passowrds don't match</p>";
  }

?>

<html>
  <head>
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="/public/assets/css/signup.css">
  </head>
  <body>

    <div class="hr-container">
      <hr width="80%">

      <div class="signup-container">

        <h1>Register</h1>
        <h2>Please enter your username, email and password</h2>

        <div class="form-container">

          <form action="verifySignup.php" method="POST">

            <label for="email">Email:</label><br />
            <input id="email" type="text" name="email" placeholder="Email..."><br />
            <label for="username">Username:</label><br />
            <input id="username" type="text" name="username" placeholder="Username..."><br />
            <label for="password">Password:</label><br />
            <input id="password" type="text" name="password"  placeholder="Password..."><br />
            <label for="password">Repeat password:</label><br />
            <input id="repeatPassword" type="text" name="repeat-password"  placeholder="Repeat password..."><br />
            <input id="register" type="submit" name="signup" value="Sign up">
          </form>
        </div>
      </div>

      <hr width="80%">
    </div>

  </body>
</html>

<?php

  require_once "../templates/footer.php";

 ?>
