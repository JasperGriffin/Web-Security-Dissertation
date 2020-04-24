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
    <div class="signup-container">

      <h1>Register</h1>

      <div class="form-container">

        <form action="verifySignup.php" method="POST">

          <label for="email">Email:</label>
          <input type="text" name="email" placeholder="Email..."><br>
          <label for="username">Username:</label>
          <input type="text" name="username" placeholder="Username..."><br>
          <label for="password">Password:</label>
          <input type="text" name="password"  placeholder="Password..."><br>
          <label for="password">Repeat password:</label>
          <input type="text" name="repeat-password"  placeholder="Repeat password..."><br>
          <input type="submit" name="signup" value="Signup">
        </form>
      </div>
    </div>
  </body>
</html>

<?php

  require_once "../templates/footer.php";

 ?>
