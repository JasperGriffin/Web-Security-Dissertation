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
      <div class="anchor-buttons">
        <button class="first-child"><a href="#Introduction">Introduction</a></button>
        <button class="middle-child"><a href="#Risks">Risks</a></button>
        <!--Stealing cookies, credential stuffing, login with admin admin, brute force session ids -->
        <button class="last-child"><a href="#Solutions">Solutions</a></button>
        <!--Two factor authorisation, password complexity, locking accoutns with too many attempts-->
      </div>
    </div>
  </body>
</html>
