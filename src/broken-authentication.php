<?php

  require_once "templates/header.php";

 ?>

<html>
  <head>
    <link rel="stylesheet" type="text/css" href="/public/assets/css/page_template.css">
    <link rel="stylesheet" type="text/css" href="/public/assets/css/broken-authentication.css">
  </head>
  <body>

  <div class="video-container">
    <video autoplay muted loop class="default-vid">
      <source src="/img/video/broken-authentication.mp4" type="video/mp4">
    </video>
  </div>
  <div class="colour-overlay"></div>

    <div class="subheadings">
      <h1>Broken authentication</h1>
      <p>Stealing cookies</p>
      <p>Credential stuffing</p>
      <p>login with 'admin' 'admin'</p>
      <p>brute force session ids</p>
      <!-- Paragraph explaining sql -->
    </div>
    <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
    <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
    <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
    <p> Fixes: </br>
    - Two factor authentication
    - Password complexity (One upper/lower case, numbers and symbols)
    - Locking accounts with too many incorrect passwords
    </p>
  </body>
</html>
