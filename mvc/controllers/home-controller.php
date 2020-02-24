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

    if ($this->conn !== NULL) {

      $result = mysqli_query($this->conn, $this->sql);
      return $result;
    }
    else {
      echo "Connection failed";
    }
  }

  public function searchData($query) {

    $s = "SELECT title FROM home_buttons WHERE title LIKE '$query%'";

    $r = mysqli_query($this->conn, $s);

    while($row = mysql_fetch_array($r, MYSQL_ASSOC)) {
      echo print_r($row);       // Print the entire row data
      echo "<br />";
    }

  }
}
?>
