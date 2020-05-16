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

  //second order sql injection: admin''--'' -> admin'--' in db

  public function insecureSignup($userCredentials) {


    $usrStr = implode("', '", $userCredentials);

    $this->sql = "INSERT INTO users (username, pwd, email, ip, date_created, last_login) VALUES ('$usrStr')";

    if (!is_null($this->conn)) {

      $this->query = mysqli_query($this->conn, $this->sql);

      if ($this->query) {

          header("Location: ../../index.php?signup=successs");
          exit();
      }
      else {
        header("Location: ../../src/account/signup.php?signup=errorr");
        exit();
      }
    }
  }

  public function secureSignup($userCredentials) {

    //without input validation, admin'--' can still be stored onto a database even with prepared statements
    //talk about input validation in diss with mysqli_real_escape_string, check function to check usernames and preg_match with regex

    $hashedPwd = password_hash($userCredentials[1], PASSWORD_DEFAULT);
    array_splice($userCredentials, 1, 1, $hashedPwd);

    $this->sql = "INSERT INTO users (username, hashed_pwd, email, ip, date_created, last_login) VALUES (?, ?, ?, ?, ?, ?)";

    if ($this->conn) {

      if ($stmt = $this->conn->prepare($this->sql)) {

        $types = str_repeat('s', count($userCredentials));

        $stmt->bind_param($types, ...$userCredentials);

        if ($stmt->execute()) {

          $check = self::setGeneralRole($userCredentials);

          if ($check == true) {
            header("Location: ../../index.php?signup=successful");
            exit();
            $stmt->close();
          }
          else {
            header("Location: ../../src/account/signup.php?error_assigning_role");
            exit();
          }
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

  public function getID($username) {

    $this->sql = "SELECT user_id FROM users WHERE username = '$username'";

    if ($this->conn) {

      $this->query = mysqli_query($this->conn, $this->sql);

      if (mysqli_num_rows($this->query) == 1) {

        $row = mysqli_fetch_array($this->query);
        $id = $row['user_id'];
        return $id;
      }
    }
  }

  public function setGeneralRole($userCredentials) {

    $id = self::getID($userCredentials[0]);
    //SELECT r.role_name FROM `users` u inner join user_roles r on u.user_id = r.role_id WHERE r.role_id = 1
    $this->sql = "INSERT INTO user_roles (role_id, role_name) VALUES ('$id', 'General')";

    if ($this->conn) {

      $this->query = mysqli_query($this->conn, $this->sql);

      if ($this->query) {
        return true;
      }
      else {
        return false;
      }
    }
  }
}

?>
