<?php

include "../../mvc/views/user-view.php";
include "../../phpmailer/mail.php";

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

          $id = $row['user_id'];
          $updateLogin =self::updateLogin($id);

          if ($updateLogin == true) {

            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['userId'] = $row['user_id'];
            $_SESSION['userUId'] = $row['username'];

            header("Location: ../../index.php?login=success");
            exit();
          }
          else {
            header("Location: ../../src/account/login.php?login_unsuccessful");
            exit();
          }

        }
        else {
          header("Location: ../../src/account/login.php?incorrect_login.$this->sql");
          exit();
          //echo "mysql_num_rows == 0<br>" . $this->sql;
        }
      }
      else {
        $err = "Error_code:" . mysqli_errno($this->conn);
        header("Location: ../../src/account/login.php?invalid_query.$err");
        exit();
        //echo "invalid mysqli query<br>" . $this->sql;
      }
    }
  }


  public function secureLogin($username, $password) {

    //prepared statements + regex'd parameters to store variables
    //https://stackoverflow.com/questions/60174/how-can-i-prevent-sql-injection-in-php

    //Why using regex won't work
    //https://security.stackexchange.com/questions/203843/is-it-possible-to-detect-100-of-sqli-with-a-simple-regex

    //For security reasons, mysqli_query will not execute multiple queries to prevent SQL injections.
    //$username = $this->conn->real_escape_string($username);
    //real_escape_string doesn't include % for LIKE clauses
    //https://websitebeaver.com/prepared-statements-in-php-mysqli-to-prevent-sql-injection

    //perhaps check if ip is different to ip  db then ->
    //two factor authorisation (as separate method)

    //potentialn concatenating strings?
    //https://vladmihalcea.com/a-beginners-guide-to-sql-injection-and-how-you-should-prevent-it/

    //REALLY INTERESTING ARTICLE
    //https://stackoverflow.com/questions/5741187/sql-injection-that-gets-around-mysql-real-escape-string

    $this->sql = "SELECT user_id, hashed_pwd, email, ip FROM users WHERE username = ?";

    if ($this->conn) {

      //$stmt = mysqli_stmt_init($this->conn);

        //checks if sql works within the database
      if ($stmt = $this->conn->prepare($this->sql)) {

          //"s" being a string data type that's being passed in
          //mysqli_stmt_bind_param($stmt, "s", $username);
          $stmt->bind_param('s', $username);

          //runs sql query
          //mysqli_stmt_execute($stmt);

          //$stmt->execute();
          if ($stmt->execute()) {

            //stores sql result back into $stmt
            //$result = mysqli_stmt_store_result($stmt);
            $stmt->store_result();
            //get_result() -> fetch_assoc

            $num_of_rows = $stmt->num_rows;

            if ($num_of_rows == 1) {

              $stmt->bind_result($id, $hashedpwd, $email, $ip);

              if ($stmt->fetch()) {

                $passwordCheck = password_verify($password, $hashedpwd);

                if ($passwordCheck == true) {

                  self::updateLogin($id);

                  $currentIP = $_SERVER['REMOTE_ADDR'];

                  //if ip doesn't = $ip ->two factor authorisation
                  if ($currentIP != $ip) {

                    session_start();
                    $_SESSION['loggedin'] = true;
                    $_SESSION['userId'] = $id;
                    $_SESSION['userUId'] = $username;

                    $stmt->close();

                    header("Location: ../../index.php?login=success_with_email");
                    exit();
                  }
                  else {

                  /*two factor authorisation*/

                  //generate token and timer
                  $token = bin2hex(random_bytes(3));

                  //send Email
                  //include "../../phpmailer/mail.php";
                  $mailController = new mail();
                  $mail = $mailController->sendEmail($token, $email);

                  //check if user input matches token
                  $view = new user_view();
                  $view->sendForm($token, $id, $username);

                  }

                }
                else {
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


}
?>
