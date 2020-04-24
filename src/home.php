<?php

	require_once "templates/header.php";

	include "mvc/views/home-view.php";
	include "mvc/models/home-model.php";
	include "mvc/controllers/home-controller.php";
?>

<html>
    <head>
	     <title>Homepage</title>
       <link rel="stylesheet" type="text/css" href="/public/assets/css/home_style.css">
    </head>
    <body>

    	<div class="header-container">
    		<h1>Types of vulnerabilities</h1>
    	</div>

			<hr width="80%">

			<?php
				//fetching home_buttons table with db connection
				$controller = new home_controller();
				$data = $controller->fetchData();

				//printing database rows
				$view = new home_view();
				$view->printData($data);

			?>
			<hr width="80%">

			<div class="info-container">
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
				Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
				Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
				Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
				</p>
			</div>

  </body>
</html>

<?php

	require_once "templates/footer.php";

?>
