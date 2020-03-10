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

    $result = mysqli_query($this->conn, $this->sql);

    echo "Num rows: ". $result->num_rows . "<br />";

    return $result;

    //$this->conn->close();
  }
}
?>
