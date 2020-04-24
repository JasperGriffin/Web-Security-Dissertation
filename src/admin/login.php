<?php

  require_once "../templates/header.php";

  if (isset($_SESSION['MAX_AUTH_LEVEL'])) {
    echo "You are an admin";
  }
  else {
    die("forbidden");
  }

?>
