
<?php


  /*function parseURL($url) {
    $newID = substr($url, strrpos($url, '=') + 1);
    return $newID;
  }

  $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

  if (preg_match('/(localhost\/index.php\?user_id=[0-9]+)/', $url) == true) {

    $id = parseURL($url);
    session_id($id);
    session_start();

    $_SESSION['loggedin'] = true;
    $_SESSION['userId'] = $id;
    $_SESSION['userUId'] = "adminn";

    echo "Token: $id";
  }
  else {
    session_start();
  }
  else if (preg_match('/(localhost\/index.php\?token=[0-9]+)/', $url) == true) {

    $token = parseURL($url);
    session_id($token);
    session_start();
    header("Location: ../../index.php?login_with_$token");
  }*/

  function getUser() {

    $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

    if (preg_match('/(localhost\/index.php\?user_id=[0-9]+)/', $url) == true) {

    }

    $id = 10;
    return $id;

    $_SESSION['loggedin'] = true;
    $_SESSION['userId'] = getUser();
    $_SESSION['userUId'] = "Admin";
  }
  session_id(getUser());
  session_start();


?>

	<html>
	<head>
		<link rel="stylesheet" type="text/css" href="/public/assets/css/header.css">
	</head>
	<header>
		<nav>
			<ul class="navbar">
				<div class="navbar-left">
					<form action='/index.php' method='get'>
						<li><button><p>Jasper Griffin</p></button></li>
					</form>
					<form action='/#' method='get'>
						<li><button><p>About</p></button></li>
					</form>
					<form action='/#' method='get'>
						<li><button><p>Contact</p></button></li>
					</form>
				</div>

					<?php if (isset($_SESSION['userId'])): ?>

						<div class='logged-in'>
							<form action='/src/account/profile.php' method='get'>
								<?php echo "<li><button><p>$_SESSION[userUId]</p></button></li>"?>
							</form>

							<form action='/src/account/logout.php' method='get' class='login-btn'>
								<button><b>Logout</b></button>
							</form>
						</div>

				<?php else: ?>
						<div class='logged-in'>
							<form action='/src/account/login.php' method='get' class='login-btn'>
								<button><b>Login</b></button>
							</form>
						</div>

				<?php endif; ?>

			</ul>
		</nav>
	</header>
</html>
