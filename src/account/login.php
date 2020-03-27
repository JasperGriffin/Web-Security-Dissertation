<?php

  require_once "../templates/header.php";

 ?>

<html>
  <head>
    <body>

      <h1>Login</h1>

      <h2>Please enter your username and password</h2>

      <form action="verify.php" method="GET">
        <label for="username">Username:</label>
        <input type="text" name="username" placeholder="Username..."><br>
        <label for="password">Password:</label>
        <input type="text" name="password"  placeholder="Password..."><br>
        <input type="submit" value="Login">
      </form>
      
    </body>
  </head>
</html>
