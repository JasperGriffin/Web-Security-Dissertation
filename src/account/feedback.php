<?php

  include_once "../templates/header.php";
  include_once "../../mvc/models/user-model.php";
  include_once "../../mvc/controllers/feedback-controller.php";

  if (!isset($_SESSION['userUId'])) {
    die("You must be logged in to make a comment");
  }

  $comment = $_POST['comment'];
  $username = $_SESSION['userUId'];

  $feedbackController = new feedback_controller();
  $comment = $feedbackController->getComment($comment);

  echo $comment . $username;

?>
