
<?php require_once("../includes/initialize.php"); ?>

<?php

/* First let's sanitize the input with clean_input function */
$c = clean_input($_GET['c']);

// We use POST to update possible new messages and GET to save a new message
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Fetch and output all messages from database
    try {
        get_all_messages();
  	}
  	catch(PDOException $e) {
  			echo "Error: " . $e->getMessage();
  	}

  	$con = null;

} else {
    // Fetch bufferpointer and save new message in correct position
    // Update new bufferpos
    // after that fetch and output all messages from database

    try {
        $con = new PDO("mysql:host=".DB_SERVER.";dbname=".DB_NAME, DB_USER, DB_PASS);

        // set the PDO error mode to exception
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Start transaction to minimize errors due to concurrency
        $con->beginTransaction();

        // Fetch bufferpointer
        $query = $con->prepare("SELECT writepos FROM bufferpointer");
        $query->execute();
        $value = $query->fetch();
        $bufferpointer = $value["writepos"];

        // Save new message in correct position
        // prepare sql and bind parameters
        $query = $con->prepare("UPDATE chat SET ip=:ip, message=:message, time=:time
        WHERE bufferpos=$bufferpointer");
        $query->bindParam(':ip', $_SERVER["REMOTE_ADDR"]);
        $query->bindParam(':message', $c);
        $query->bindParam(':time', date("Y-m-d H:i:s"));
        $query->execute();

        // Update new bufferpos for next incoming message
        $query = $con->prepare("UPDATE bufferpointer SET writepos=:writepos
        WHERE writepos=$bufferpointer");
        $new_bufferpointer= ($bufferpointer < 6 ? ++$bufferpointer : 1);
        $query->bindParam(':writepos', $new_bufferpointer);
        $query->execute();

        // If no errors, then the transactions should be atomic and we can commit.
        // BUT NOTICE:
        // To be 100% sure, you would have to set the right isolation levels in mysql Innodb table engine
        $con->commit();

        // Fetch and output all messages from database
        get_all_messages();


    }
    catch(PDOException $e) {
          // errors
          $con->rollback();
          echo "Error: " . $e->getMessage();
    }
    $con = null;

}

?>
