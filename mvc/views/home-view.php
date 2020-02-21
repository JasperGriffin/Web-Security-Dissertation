<?php

	require "public/assets/html/home.html";

	class view {

		public function printData($data) {

			if ($data->num_rows > 0) {
	      echo "<div class='home-btn'>";
	      while ($row = $data->fetch_assoc()) {
	        echo "<button class='$row[class_name]'><a href='$row[php_page]'><b>$row[title]</b></a></button>";
	      }
	      echo "</div>";
	    }
		}
	}
?>
