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

    //$username = $this->conn->real_escape_string($username);

    //WHERE username = 'admin ' or '1 = '1' and pwd = 'lkjhkjhgkldjfhg";
    $this->sql = "SELECT user_id, username, pwd FROM users WHERE username = '$username' and pwd = '$password'";

    //For security reasons, mysqli_query will not execute multiple queries to prevent SQL injections.

    if ($this->conn) {

      $this->query = mysqli_query($this->conn, $this->sql);

      if ($this->query) {

        if (mysqli_num_rows($this->query) == 1) {

          $row = mysqli_fetch_array($this->query, MYSQLI_ASSOC);
          $id = $row['user_id'];

          session_start();
          $_SESSION['loggedin'] = true;
          $_SESSION['userId'] = $row['user_id'];
          $_SESSION['userUId'] = $row['username'];

          $_SESSION['test'] = $this->sql;

          self::updateLogin($id);
        }
        else {
          /*header("Location: ../../src/account/login.php?incorrect_login.$this->sql");
          exit();*/
          echo "mysql_num_rows == 0<br>" . $this->sql;
        }
      }
      else {
        /*$err = "Error_code:" . mysqli_errno($this->conn);
        header("Location: ../../src/account/login.php?invalid_query.$err");
        exit();*/
        echo "invalid mysqli query<br>" . $this->sql;
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
        header("Location: ../../index.php?login=successful.id=$id");
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
