
<?php

	session_start();
	$url = $_SERVER['PHP_SELF'];
	$login = "/src/account/login.php";

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

				<!--Check to disable login button when logging in-->
				<?php if ($url != $login): ?>

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
				<?php endif; ?>

			</ul>
		</nav>
	</header>
</html>
