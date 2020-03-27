<?php

class user_controller extends user_model {

  private $conn;
  private $sql;

  public function __construct() {

    $db = new parent();
    $this->conn = $db->connect();
  }

  public function insecureLogin($username, $password) {

    $this->sql = "SELECT user_id, username, pwd FROM users";

    //Insecure login
    if (!is_null($this->conn)) {

      $result = mysqli_query($this->conn, $this->sql);

			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

        if ($username == $row['username'] && $password == $row['pwd']) {

          session_start();
          $_SESSION['userId'] = $row['user_id'];
          $_SESSION['userUId'] = $row['username'];

          header("Location: ../../index.php?login=success");
          exit();
        }
        else {
          header("Location: http://localhost/src/account/login.php");
        }
	    }
    }
  }

  public function secureLogin($username, $password) {

  }

}
?>
