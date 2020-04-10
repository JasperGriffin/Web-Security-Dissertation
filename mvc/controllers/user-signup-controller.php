<?php

class user_signup_controller extends user_model {

  private $conn;
  private $sql;
  private $query;

  //constructor
  public function __construct() {

    $db = new parent();
    $this->conn = $db->connect();
  }

  public function insecureSignup($userCredentials) {

    // array($username, $password, $email, $ip, $dateCreated, $lastLogin);
    $hashedPwd = password_hash($userCredentials[1], PASSWORD_DEFAULT);
    array_splice($userCredentials, 2, 0, $hashedPwd);
    $usrStr = implode("', '", $userCredentials);

    $this->sql = "INSERT INTO users (username, pwd, hashed_pwd, email, ip, date_created, last_login) VALUES ('$usrStr')";

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

  public function checkUsername($username) {

    $this->sql = "SELECT username FROM users WHERE username = '$username'";

    if ($this->conn) {

      $this->query = mysqli_query($this->conn, $this->sql);

      if (mysqli_num_rows($this->query) > 0) {
        return true;
      }
    }
  }

}

?>