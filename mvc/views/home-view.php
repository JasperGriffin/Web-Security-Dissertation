<?php

	require "public/assets/html/home.html";

	class home_view {

		public function printData($data) {

			if ($data->num_rows > 0) {

	      echo "<div class='home-btn'>";
		      while ($row = $data->fetch_assoc()) {

						/*<a class="btn btn-primary" role="button">Link</a>*/
						//change button class to a tag
		        echo "<button class='$row[class_name]'><a href='/src/$row[php_page]'><b>$row[title]</b></a></button>";
						/*echo "<a class='$row[class_name]' role='button' href='/src/$row[php_page]'><b>$row[title]</b></a>";*/
		      }
	      echo "</div>";
	    }
		}

		public function printQuery($data) {

			if ($data->num_rows > 0) {
				while ($row = mysqli_fetch_array($data, MYSQLI_ASSOC)) {
		        echo $row['title']. "<br />";
		    }
			}
		}

	}
?>
