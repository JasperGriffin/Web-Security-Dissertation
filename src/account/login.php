<?php

  require_once "../templates/header.php";

  if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header("Location: ../../index.php");
    exit();
  }

  //error checking
  $url = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

  if (strpos($url, "invalid_query") == true) {
    echo "<p>Error:</p>";
  }

 ?>

<html>
  <head>
    <body>

      <h1>Login</h1>

      <h2>Please enter your username and password</h2>

      <!--Vulnerability: using GET request for logins -->
      <form action="verifyLogin.php" method="GET">
        <label for="username">Username:</label>
        <input type="text" name="username" placeholder="Username..."><br>
        <label for="password">Password:</label>
        <input type="text" name="password"  placeholder="Password..."><br>
        <input type="submit" name="login" value="login">
      </form>

      <a href="signup.php">Sign up</a>
    </body>
  </head>
</html>
