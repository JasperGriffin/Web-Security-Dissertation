<?php

	include "mvc/models/home-model.php";

  if (isset($_GET['submit'])) {
    //works. Ideal if called from another php file

    $m = new home_model();
    $conn = $m->connect();

    $search = $conn->real_escape_string($_GET['search']);

    $data = $conn->query("SELECT title FROM home_buttons WHERE $search LIKE '%$search%'");
    if ($data->num_rows > 0) {
      echo "success";

      if ($data->) {
        while($row = $data->fetch_assoc()) {
          echo $row['title'];
        }
      }



    }
    else {
      echo "fail";
    }
  }

?>
