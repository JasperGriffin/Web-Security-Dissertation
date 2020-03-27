<?php

	require_once "templates/header.php";

	include('C:\xampp\htdocs\public\assets\html\home.html');

	include "mvc/views/home-view.php";
	include "mvc/models/home-model.php";
	include "mvc/controllers/home-controller.php";

	//fetching home_buttons table with db connection
	$controller = new home_controller();
	$data = $controller->fetchData();

	//printing database rows
	$view = new home_view();
	$view->printData($data);

?>
