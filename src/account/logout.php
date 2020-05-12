<?php

  session_start();
  session_regenerate_id();
  session_unset();
  session_destroy();
  $_SESSION = array();

  header("Location: ../../index.php");
  exit();
?>
