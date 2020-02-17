<?php

    //call database "home_buttons" and pull over fields for class name, href and title
    //issue is unable to set a number of buttons, that's to be sorted by the database

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbName = "home";

    $conn = mysqli_connect($servername, $username, $password, $dbName);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT class_name, php_page, title FROM home_buttons";
    $result = $conn->query($sql);

    echo "<div class='home-btn'>";
    if ($result->num_rows > 0) {

      while ($row = $result->fetch_assoc()) {

        echo "<button class='$row[class_name]'><a href='$row[php_page]'>$row[title]</a></button>";
      }
    }
    else {
        echo "table is empty";
    }
    echo "</div>";
    $conn->close();

    /* <button class="csfr"><a href="cross-site-forgery-request.php">Vulnerability #3</a></button>
     <button class="ba"><a href="broken-authentication.php">Broken authentication - credential stuffing, having multi-factor authorisation</a></button>
     <button class="sde"><a href="sensitive-data-exposure.php">Weak ciphers, pages not encrypted, protocol downgrade attacks</a></button>
     */
 ?>
