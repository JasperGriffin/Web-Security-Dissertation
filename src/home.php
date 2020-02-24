<?php

	require_once "templates/nav.php";

	include "mvc/views/home-view.php";
	include "mvc/models/home-model.php";
	include "mvc/controllers/home-controller.php";
	include "search.php";

	//fetching home_buttons table with db connection
	$controller = new home_controller();
	$data = $controller->fetchData();

	//printing database rows
	$view = new home_view();
	$view->printData($data);

?>
