<?php

	require "public/assets/html/home.html";

	class home_view {

		public function printData($data) {

			if ($data->num_rows > 0) {

	      echo "<div class='home-btn'>";
		      while ($row = $data->fetch_assoc()) {
						echo "<form action='/src/$row[php_page]' method='get'>";
		        	echo "<button class='$row[class_name]'><p><b>$row[title]</b></p></button>";
						echo "</form>";
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
