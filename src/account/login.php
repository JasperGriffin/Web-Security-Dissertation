<?php

  require_once "../templates/header.php";

  if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header("Location: ../../index.php");
    exit();
  }

  //error checking
  $url = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

  if (strpos($url, "empty_fields") == true) {
    echo "<p>Please enter all fields</p>";
  }
  else if (strpos($url, "mail_server_disconnected") == true) {
    echo "<p>Email server cannot connect</p>";
  }

 ?>

<html>
  <head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="/public/assets/css/login.css">
  </head>
  <body>

    <div class="hr-container">

      <hr width="80%">

      <div class="login-container">

        <h1>Login</h1>
        <h2>Please enter your username and password</h2>

        <div class="form-container">
          <!--Vulnerability: using GET request for logins -->
          <form action="verifyLogin.php" method="POST">
            <!--<label for="username">Username:</label><br />-->
            <input id="username" type="text" name="username" placeholder="Username..."><br />
            <!--<label for="password">Password:</label><br />-->
            <input id="password" type="text" name="password"  placeholder="Password..."><br />
            <input id="login" type="submit" name="login" value="Login">
          </form>
          <br />
          <div class="a-tag">
            <a href="signup.php">No account? Create one here!</a>
          </div>
        </div>
      </div>
      <hr width="80%">
    </div>


  </body>
</html>

<?php

  require_once "../templates/footer.php";

 ?>
