<?php

  if (isset($_GET['submit']) && !empty($_GET['search'])) {

		$search = $_GET['search'];

    //fetch user data //controller
		$controller = new home_controller();
		$data = $controller->searchData($search);

  }

?>
