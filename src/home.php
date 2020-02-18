<?php
	require_once "templates/nav.php";
	require_once "templates/nav.php";
?>

<html>
<head>
	<title>Homepage</title>
		<link rel="stylesheet" type="text/css" href="/public/assets/css/home_style.css">
</head>
<body>

	<div class="header">
		<h1>Types of vulnerabilities</h1>
		<hr width="80%">
	</div>

	<!-- New search bar -->
	<form action="something.php" method="GET">
		<div class="search">
			<input type="text" name="search" placeholder="Search...">
			<input type="submit">
		</div>
	</form>

	<?php

			include("home_buttons.php");
			$database = new database();
			$data = $database->getData();
	 ?>

</body>
</html>
