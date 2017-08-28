<?php

/**
 * Sanitizes the input to prevent injections and so on
 * @return string
 */
function clean_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


/**
 * Fetch and output all messages from database
 * This should always when called be in a try -catch
 * (echos directly, could be changed to return string or boolean)
 */
function get_all_messages() {
	$con = new PDO("mysql:host=".DB_SERVER.";dbname=".DB_NAME, DB_USER, DB_PASS);

	// set the PDO error mode to exception
	$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$query = $con->prepare("SELECT * FROM chat ORDER BY time DESC");
	$query->execute();

	// set the resulting array to associative
	$result = $query->setFetchMode(PDO::FETCH_ASSOC);
	while ($row = $query->fetch()) {
			echo '<article class="viesti">';
			echo '<p>' . htmlspecialchars($row["message"]) . "</p>";
			echo '<footer>';
			echo '<p>Bufferpointer--> ' . htmlspecialchars($row["bufferpos"]) ."<br>";
			echo 'Who: ' . htmlspecialchars($row["ip"]) . "<br>";
			echo 'When: <time>' . htmlspecialchars(datetime_to_text($row["time"])) . "</time></p>";
			echo '</footer>';
			echo '</article>';
	}
}

/**
 * Handle date and time output in preferred European format
 * @return string
 */
function datetime_to_text($datetime="") {
  $unixdatetime = strtotime($datetime);
  return strftime("%H:%M:%S	%d.%m.%Y", $unixdatetime);
}


?>
