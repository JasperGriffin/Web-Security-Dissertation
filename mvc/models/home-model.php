<?php

class model {

  //to call private variables, $this->[variable_name]
  private $connection;
  private $servername = "localhost";
  private $username = "root";
  private $password = "";
  private $dbName = "home";

  //magic method: the constructor of a class (called after object is creaetd)
  public function connect() {

    $this->connection = mysqli_connect($this->servername, $this->username, $this->password, $this->dbName);

    if ($this->connection->connect_error) {
        die("Connection failed: " . $this->connection->connect_error);
    }

    return $this->connection;
  }
}
?>
