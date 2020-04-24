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

    //second order sql injection: admin''--'' -> admin'--' in db

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

  public function secureSignup($userCredentials) {

    //without input validation, admin'--' can still be stored onto a database even with prepared statements
    //talk about input validation in diss with mysqli_real_escape_string, check function to check usernames and preg_match with regex

    $hashedPwd = password_hash($userCredentials[1], PASSWORD_DEFAULT);
    array_splice($userCredentials, 2, 0, $hashedPwd);

    $this->sql = "INSERT INTO users (username, pwd, hashed_pwd, email, ip, date_created, last_login) VALUES (?, ?, ?, ?, ?, ?, ?)";

    if ($this->conn) {

      if ($stmt = $this->conn->prepare($this->sql)) {

        $types = str_repeat('s', count($userCredentials));

        $stmt->bind_param($types, ...$userCredentials);

        if ($stmt->execute()) {
          header("Location: ../../index.php?signup=successful");
          exit();
          $stmt->close();
        }
        else {
          header("Location: ../../src/account/signup.php?signup_error");
          exit();
        }
      }
      else {
        header("Location: ../../index.php?sql_error");
        exit();
      }

    }

  }

  public function checkUsername($username) {

    $this->sql = "SELECT username FROM users WHERE username = '$username'";

    if ($this->conn) {

      $this->query = mysqli_query($this->conn, $this->sql);

      if (mysqli_num_rows($this->query) == 1) {
        return true;
      }
    }
  }

}

?>
