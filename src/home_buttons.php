<?php

    //call database "home_buttons" and pull over fields for class name, href and title
    //issue is unable to set a number of buttons, that's to be sorted by the database

    class database {

      private $connection;
      private $servername = "localhost";
      private $username = "root";
      private $password = "";
      private $dbName = "home";

      //magic method: the constructor of a class (called after object is creaetd)
      public function __construct() {

        $this->connection = mysqli_connect($this->servername, $this->username, $this->password, $this->dbName);

        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
      }

      public function getData() {

        $sql = "SELECT class_name, php_page, title FROM home_buttons";

        if ($this->connection !== NULL) {

          $result = $this->connection->query($sql);
          $this->printData($result);
        }
        else {
          echo "Connection failed";
        }
      }

      public function printData($data) {

        if ($data->num_rows > 0) {
  				echo "<div class='home-btn'>";
  				while ($row = $data->fetch_assoc()) {
  					echo "<button class='$row[class_name]'><a href='$row[php_page]'>$row[title]</a></button>";
  				}
  				echo "</div>";
  			}
      }

    }





    /* <button class="csfr"><a href="cross-site-forgery-request.php">Vulnerability #3</a></button>
     <button class="ba"><a href="broken-authentication.php">Broken authentication - credential stuffing, having multi-factor authorisation</a></button>
     <button class="sde"><a href="sensitive-data-exposure.php">Weak ciphers, pages not encrypted, protocol downgrade attacks</a></button>
     */
 ?>
