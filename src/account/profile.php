<?php

  include "../templates/header.php";

  if (!isset($_SESSION['userId'])) {
    echo "
      <div class = 'blocked'>
        <p>You must be logged in view your profile</p>
      </div>
    ";
    exit();
  }

  $url = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

  if (strpos($url, "password_reset") == true) {
    echo "<p>Password reset successfully</p><br>";
  }

?>

<html>
  <head>
    <title>Profile</title>
    <link rel="stylesheet" type="text/css" href="/public/assets/css/profile.css">
  </head>
  <body>

    <h1>Username: <?php echo"$_SESSION[userUId]"  ?></h1>
    <h1>Session: <?php echo session_id()  ?></h1>

    <form action='editProfile.php' method='post'>
      <button type='submit'>Edit profile</button>
    </form>

    <form action='passwordReset.php' method='post'>
      <button type="submit">Password reset</button>
    </form>
  </body>
</html>

<?php

  include_once "../templates/footer.php";
?>
