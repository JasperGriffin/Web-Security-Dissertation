<?php

	class home_view {

		public function printData($data) {

			if ($data->num_rows > 0) {

	      echo "<div class='home-btn-container'>";
		      while ($row = $data->fetch_assoc()) {
						echo "<form action='/src/vulnerabilities/$row[php_page]' method='get'>";
		        	echo "<button class='$row[class_name]'><p><b>$row[title]</b></p></button>";
						echo "</form>";
		      }
	      echo "</div>";
	    }

		}

		public function printQuery($data) {

			if ($data->num_rows > 0) {
				echo "<div class='result-container'>";
					echo "<h2>Results:</h2>";
						while ($row = mysqli_fetch_array($data, MYSQLI_ASSOC)) {
				        echo "<p>$row[title]</p>";
				    }
				echo "</div>";
			}
		}

	}
?>
