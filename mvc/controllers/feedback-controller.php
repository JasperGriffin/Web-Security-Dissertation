<?php

  class feedback_controller extends user_model {

    private $conn;
    private $sql;
    private $query;

    //constructor
    public function __construct() {

      $db = new parent();
      $this->conn = $db->connect();
    }

    public function getComment($comment) {
      return "Comment . $comment";
    }
  }

?>
