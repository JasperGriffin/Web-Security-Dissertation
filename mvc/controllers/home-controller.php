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

    $this->sql = "SELECT title FROM home_buttons WHERE title LIKE '$query%'";

    $r = mysqli_query($this->conn, $this->sql);

    while ($row = mysqli_fetch_array($r)) {
      print_r($row). "<br />";
    }


  }
}
?>
