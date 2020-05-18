<?php

include "../../mvc/views/user-view.php";
include "../../phpmailer/mail.php";
include_once "../../src/session/sessionHandling.php";

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

    //WHERE username = 'admin ' or '1 = '1' and pwd = 'lkjhkjhgkldjfhg";
    $this->sql = "SELECT * FROM users WHERE username = '$username' and pwd = '$password'";

    if ($this->conn) {

      $this->query = mysqli_query($this->conn, $this->sql);

      if ($this->query) {

        if ($row = mysqli_fetch_array($this->query, MYSQLI_ASSOC)) {

          session_start();
          $_SESSION['loggedin'] = true;
          $_SESSION['userId'] = $row['user_id'];
          $_SESSION['userUId'] = $row['username'];

          header("Location: ../../index.php?username=$username&password=$password");
          exit();

        }
        else {
          header("Location: ../../src/account/login.php?incorrect_login");
          exit();
          //echo "mysql_num_rows == 0<br>" . $this->sql;
        }
      }
      else {
        header("Location: ../../src/account/login.php?invalid_query");
        exit();
        //echo "invalid mysqli query<br>" . $this->sql;
      }
    }
  }


  public function secureLogin($username, $password) {

    $this->sql = "SELECT user_id, hashed_pwd, email, ip FROM users WHERE username = ?";

    if ($this->conn) {

      //checks if sql works within the database
      if ($stmt = $this->conn->prepare($this->sql)) {

          //"s" being a string data type that's being passed in
          $stmt->bind_param('s', $username);

          //runs sql query

          //$stmt->execute();
          if ($stmt->execute()) {

            //stores sql result back into $stmt
            $stmt->store_result();

            $num_of_rows = $stmt->num_rows;

            if ($num_of_rows == 1) {

              $stmt->bind_result($id, $hashedpwd, $email, $ip);

              if ($stmt->fetch()) {

                $passwordCheck = password_verify($password, $hashedpwd);

                if ($passwordCheck == true) {

                  self::updateLogin($id);

                  $currentIP = $_SERVER['REMOTE_ADDR'];

                  //if ip doesn't = $ip ->two factor authorisation
                  if ($currentIP == $ip) {

                    $stmt->close();

                    $sessionController = new sessionHandling();
                    $sessionController->setMeaningfulSession($id);

                  }
                  else {

                    /*two factor authorisation*/
                    self::setTwoFactorAuth($id, $username, $email, $ip);
                  }
                }
                else {
                  //malicious users can use this error message to know that user with this username exists -> second order sql injection
                  header("Location: ../../src/account/login.php?incorrect_password");
                  exit();
                }
              }
              else {
                header("Location: ../../src/account/login.php?cannot_fetch");
                exit();
              }
            }
            else {
              header("Location: ../../src/account/login.php?incorrect_login");
              exit();
            }

          }
          else {
            header("Location: ../../src/account/login.php?invalid_username_characters");
            exit();
          }
        }
        else {
          header("Location: ../../src/account/login.php?invalid_username");
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
        return true;
      }
      else {
        return false;
      }
    }
  }

  public function setTwoFactorAuth($id, $username, $email, $ip) {

    $timeStart  = time();

    //generate token and timer
    $token = bin2hex(random_bytes(3));

    $counter = 0;

    //send Email
    //include "../../phpmailer/mail.php";
    $mailController = new mail();
    $mail = $mailController->sendEmail($token, $username, $email, $ip);

    //check if user input matches token
    $view = new user_view();
    $view->sendForm($token, $id, $username, $email, $ip, $timeStart, $counter);

  }


  public function passwordReset($password) {

    //$password = mysqli_real_escape_string($password);
    $password = mysqli_real_escape_string($this->conn, $password);

    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

    $username =  $_SESSION['userUId'];

    //insecureSignup: admin''--''
    //when logged in as admin'--', password is updated for admin user instead
    $this->sql = "UPDATE users SET pwd = '$password', hashed_pwd = '$hashedPwd' WHERE username = '$username'";

    if ($this->conn) {

      $this->query = mysqli_query($this->conn, $this->sql);

      if ($this->query) {

        header("Location: ../../src/account/profile.php?password_reset=$password");
        exit();
      }
      else {
        header("Location: ../../src/account/passwordReset.php?unknown_error");
        exit();
      }
    }
    else {
      header("Location: ../../src/account/passwordReset.php?connection_error");
      exit();
    }
  }
}
?>
