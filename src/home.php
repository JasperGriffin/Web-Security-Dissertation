<?php
	//view
	require_once "templates/nav.php";

	include "mvc/views/home-view.php";
	include "mvc/models/home-model.php";
	include "mvc/controllers/controller.php";

	$model = new model();

	//connecting to database
	$conn = $model->connect();

	$controller = new controller();

	//fetching home_buttons table with db connection
	$data = $controller->fetchData();

	$view = new view();

	//printing database rows
	$view->printData($data);

	//$data = $home->getData();
?>
