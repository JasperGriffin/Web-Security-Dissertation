<?php

class home_model {

  //to call private variables, $this->[variable_name]
  private $connection;
  private $servername = "localhost";
  private $username = "root";
  private $password = "";
  private $home = "home";

  public function connect() {

    $this->connection = mysqli_connect($this->servername, $this->username, $this->password, $this->home);

    if ($this->connection->connect_error) {
        die("Connection failed: " . $this->connection->connect_error);
    }
    return $this->connection;
  }

  public function destroy() {
    mysqli_close($this->connection);
  }
}
?>
