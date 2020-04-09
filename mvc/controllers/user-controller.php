<?php

class user_controller extends user_model {

  private $conn;
  private $sql;
  private $query;

  //constructor
  public function __construct() {

    $db = new parent();
    $this->conn = $db->connect();
  }

  public function login($username, $password) {

    $this->sql = "SELECT user_id, username, pwd FROM users WHERE username = '$username' and pwd = '$password'";

    if ($this->conn) {

      $this->query = mysqli_query($this->conn, $this->sql);

      if ($this->query) {
        if (mysqli_num_rows($this->query) == 1) {

          session_start();
          $_SESSION['loggedin'] = true;
          $_SESSION['userId'] = $row['user_id'];
          $_SESSION['userUId'] = $row['username'];
          $id = $row['user_id'];

        }
      }
    }
  }


  public function insecureLogin($username, $password) {

    //where username =  $username (since usernames are unique)
    $this->sql = "SELECT user_id, username, hashed_pwd FROM users WHERE username = '$username'";

    if ($this->conn) {

      $this->query = mysqli_query($this->conn, $this->sql);

			if ($this->query) {

        if (mysqli_num_rows($this->query) == 1) {

          $row = mysqli_fetch_array($this->query, MYSQLI_ASSOC);

          $hash = $row['hashed_pwd'];

          if (password_verify($password, $hash)) {

            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['userId'] = $row['user_id'];
            $_SESSION['userUId'] = $row['username'];
            $id = $row['user_id'];

            self::updateLogin($id);
          }
          else {
            header("Location: ../../index.php?password_unverified");
            exit();
          }

        }
        else {
          header("Location: ../../src/account/login.php?incorrect_login.$this->sql");
          exit();
        }
	    }
      else {
        $err = "Error_code:" . mysqli_errno($this->conn);
        header("Location: ../../src/account/login.php?invalid_query.$err");
        exit();
      }
    }
  }

  public function secureLogin($username, $password) {
    //prepared statements + regex'd parameters to store variables
    //https://stackoverflow.com/questions/60174/how-can-i-prevent-sql-injection-in-php
    //two factor authorisation (as separate method)
  }

  public function updateLogin($id) {

    //update last_login with new update
    $lastLogin = date("Y-m-d");

    $this->sql = "UPDATE users SET last_login = '$lastLogin' WHERE user_id = '$id'";

    if ($this->conn) {

      $this->query = mysqli_query($this->conn, $this->sql);

      if ($this->query) {
        header("Location: ../../index.php?login=successful");
        exit();
      }
      else {
        header("Location: ../../index.php?update_query_unsuccessful");
        exit();
      }
    }
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

    //where username = $username
    //if row is more than 0, return true
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
