<?php

	require_once "templates/nav.php";

	include "mvc/views/home-view.php";
	include "mvc/models/home-model.php";
	include "mvc/controllers/home-controller.php";

	if (isset($_GET['submit'])) {
		//works. Ideal if called from another php file

		$m = new home_model();
		$conn = $m->connect();

		$search = $conn->real_escape_string($_GET['search']);

		$data = $conn->query("SELECT title FROM home_buttons WHERE title LIKE '%$search%'");
		if ($data->num_rows > 0) {
			echo "success";

		}
		else {
			echo "fail";
		}
	}

	//connecting to database
	$model = new home_model();
	$conn = $model->connect();

	//fetching home_buttons table with db connection
	$controller = new home_controller();
	$data = $controller->fetchData();

	//printing database rows
	$view = new home_view();
	$view->printData($data);

?>
