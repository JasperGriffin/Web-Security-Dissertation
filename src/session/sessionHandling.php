<?php

include_once("C:/xampp\htdocs\mvc\models\user-model.php");

class sessionHandling {

  private $conn;
  private $sql;
  private $query;
  private $arrLength = 6;

  /*SESSION VIOLATION: sessio is meaningful as it's set equal to the consecutive user id*/
  /*Can either steal a user's session id by either in the URL or in the browser cookies*/
  /*Additionally, session isn't regenerated with each login*/
  public function setMeaningfulSession($id) {
    header("Location: ../../index.php?user_id=$id");
    exit();
  }

  public function getMeaningfulSession($url) {

    $id = substr($url, strrpos($url, '=') + 1);

    $username = self::getUsername($id);

    session_id($id);
    session_start();
    $_SESSION['loggedin'] = true;
    $_SESSION['userId'] = $id;
    $_SESSION['userUId'] = $username;

    header("Location: index.php?login=successful_with_id");
  }

  /*SESSION VIOLATION: session has small */
  public function setWeakSession($id) {

    //come up with number generation
    //2^(b+1) / (2 * A * S)
    //Where b = no of bits of entropy, a = no of guesses per sec, s = no of valid tokens

    $charSet = "1234567890";
    $arr = array();
    $setLength = strlen($charSet) - 1;

    for ($i = 0; $i < $this->arrLength; $i++) {
      $rand = rand(0, $setLength);
      $arr[] = $charSet[$rand];
    }

    $token = $id . implode($arr);

    header("Location: ../../index.php?token=$token");
    exit();
  }

  public function getWeakSession($url) {

    $token = substr($url, strrpos($url, '=') + 1);
    $id = substr($token, 0, strlen($token) - $this->arrLength);

    $username = self::getUsername($id);

    session_id($token);
    session_start();
    $_SESSION['loggedin'] = true;
    $_SESSION['userId'] = $id;
    $_SESSION['userUId'] = $username;

    header("Location: index.php?login=successful_with_token");
  }

  public function getUsername($id) {

    $db = new user_model();
    $this->conn = $db->connect();
    $this->sql = "SELECT username FROM users WHERE user_id = $id";
    $this->query = mysqli_query($this->conn, $this->sql);

    if ($this->query) {
      $row = mysqli_fetch_array($this->query);
      $username = $row['username'];
      return $username;
    }
  }

  public function setAdminSession() {

    session_regenerate_id(TRUE);
    $_SESSION['MAX_AUTH_LEVEL'] = true;
    header("Location: ../../index.php?login_success");
    exit();
  }
}

?>
