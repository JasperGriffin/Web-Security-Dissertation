<?php

class controller extends model {

  private $conn;

  public function __construct() {
    $db = new parent();
    $this->conn = $db->connect();
  }

  //controller
  public function fetchData() {

    $sql = "SELECT class_name, php_page, title FROM home_buttons";

    if ($this->conn !== NULL) {

      $result = mysqli_query($this->conn, $sql);
      return $result;
    }
    else {
      echo "Connection failed";
    }
  }
}
?>
