<?php

class user_model {

  //to call private variables, $this->[variable_name]
  private $connection;
  private $servername = "localhost";
  private $username = "root";
  private $password = "";
  private $user = "users";

  public function connect() {

    $this->connection = mysqli_connect($this->servername, $this->username, $this->password, $this->user);

    if ($this->connection->connect_error) {
        die("Connection failed: " . $this->connection->connect_error);
    }
    return $this->connection;
  }
}

?>
