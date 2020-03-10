
<?php

$foo = True;

?>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="/public/assets/css/header.css">
	</head>
	<header>

		<nav>
			<ul class="navbar">
				<form action='/index.php' method='get'>
					<li><button><p>Jasper Griffin</p></button></li>
				</form>
				<form action='/#' method='get'>
					<li><button><p>About</p></button></li>
				</form>
				<form action='/#' method='get'>
					<li><button><p>Contact</p></button></li>
				</form>
			</ul>
	</nav>

		<?php if ($foo == true): ?>
			<form action='/account/login.php' method='get' class="login-btn">
				<button><p><b>Login</b></p></button>
			</form>
		<?php endif ?>
		
	</header>
</html>
