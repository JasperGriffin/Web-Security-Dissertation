<?php

class user_controller extends user_model {

  private $conn;
  private $sql;
  private $query;

  public function __construct() {

    $db = new parent();
    $this->conn = $db->connect();
  }

  public function insecureLogin($username, $password) {

    $this->sql = "SELECT user_id, username, pwd FROM users";

    if (!is_null($this->conn)) {

      $this->query = mysqli_query($this->conn, $this->sql);

			while ($row = mysqli_fetch_array($this->query, MYSQLI_ASSOC)) {

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
    //prepared statements + regex'd parameters to store variables
    //https://stackoverflow.com/questions/60174/how-can-i-prevent-sql-injection-in-php
  }

  public function insecureSignup($email, $username, $password, $repeatPassword, $ip, $dateCreated, $lastLogin) {

    $hashedPwd = password_hash($repeatPassword, PASSWORD_DEFAULT);

    $this->sql = "INSERT INTO users (username, pwd, hashed_pwd, email, ip, date_created, last_login) VALUES ('$username', '$password', '$hashedPwd', '$email', '$ip', '$dateCreated', '$lastLogin')";

    if (!is_null($this->conn)) {

      $this->query = mysqli_query($this->conn, $this->sql);

      if ($this->query) {
        header("Location: ../../index.php?signup=success");
        exit();
      }
      else {
        header("Location: ../../src/account/signup.php?signup=error");
        exit();
      }
    }
  }

  public function secureSignup() {

  }

  public function checkUsername($username) {

    $this->sql = "SELECT username FROM users";

    if (!is_null($this->conn)) {

      $this->query = mysqli_query($this->conn, $this->sql);
      while($row = mysqli_fetch_array($this->query, MYSQLI_ASSOC)) {

        if ($username == $row['username']) {

          return true;
        }
      }
    }
  }

}
?>
