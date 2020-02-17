<?php
	include "templates/nav.php";
?>

<html>
<head>
	<title>Homepage</title>
	<link rel="stylesheet" type="text/css" href="/public/assets/css/home_style.css">
</head>
<body>

	<div class="header">
		<h1>Types of vulnerabilities</h1>
		<!-- Search bar -->
		<hr width="80%">
	</div>

	<!-- New search bar -->
	<form action="something.php" method="GET">
		<input type="text" name="search" placeholder="Search...">
	</form>
	<!-- -->

	<?php
			include "home_buttons.php";
	 ?>

</body>
</html>
