
<?php

//RENAME TO HEADER. POTENTIALLY ADD FOOTER

$foo = True;

?>

<link rel="stylesheet" type="text/css" href="/public/assets/css/navbar_style.css">

<header>

	<nav>
		<ul class="navbar">
			<li><button><a href="home.php">Jasper Griffin</a></button></li>
			<li><button><a href="about.php">About</a></button></li>
			<li><button><a href="#">Contact</a></button></li>
		</ul>
	</nav>

	<div class="login-btn">

		<?php if ($foo == true): ?>
			<button><a href=""><b>Login</b></a></button>
		<?php endif ?>

		<?php if ($foo == false): ?>
			<a href="">
				<button><a href=""><b>Logout</b></a></button>
			</a>
		<?php endif ?>

	</div>

</header>
