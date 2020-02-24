<?php

  if (isset($_GET['submit'])) {

		$search = $_GET['search'];

		//fetch user data //controller
		$controller = new home_controller();
		$data = $controller->searchData($search);

		//printing database rows

  }

?>
