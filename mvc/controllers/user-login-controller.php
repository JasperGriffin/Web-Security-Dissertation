<?php

class user_login_controller extends user_model {

  private $conn;
  private $sql;
  private $query;

  //constructor
  public function __construct() {

    $db = new parent();
    $this->conn = $db->connect();
  }

  public function insecureLogin($username, $password) {

    //$this->sql = "SELECT user_id, username, pwd FROM users WHERE username = '$username' and pwd = '$password'";
    $this->sql = "SELECT user_id, username, pwd FROM users WHERE username = '$username'";

    if ($this->conn) {

      $this->query = mysqli_query($this->conn, $this->sql);

      if ($this->query) {

        if (mysqli_num_rows($this->query) == 1) {

          $row = mysqli_fetch_array($this->query, MYSQLI_ASSOC);

          session_start();
          $_SESSION['loggedin'] = true;
          $_SESSION['userId'] = $row['user_id'];
          $_SESSION['userUId'] = $row['username'];

          self::updateLogin($id);
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

            $updateLogin = self::updateLogin($id);

            if ($updateLogin == true) {

              //two-factor-authroiosation() 

            }
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

  public function updateLogin($id) {

    //update last_login with new update
    $lastLogin = date("Y-m-d");

    $this->sql = "UPDATE users SET last_login = '$lastLogin' WHERE user_id = '$id'";

    if ($this->conn) {

      $this->query = mysqli_query($this->conn, $this->sql);

      if ($this->query) {
        header("Location: ../../index.php?login=successful_through_update");
        exit();
      }
      else {
        header("Location: ../../index.php?update_query_unsuccessful");
        exit();
      }
    }
  }
}
?>
