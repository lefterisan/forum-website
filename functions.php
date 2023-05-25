
<?php
//xrisima functions
 if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
ini_set ('display_errors', 1); ini_set ('display_startup_errors', 1); error_reporting(E_ALL);

function check_login(){ //checkaro an eina sindedemenos dini false h true
    // print_r($_SESSION);
    if (isset($_SESSION["user_id"])) {
    
    $mysqli =conn();
    
    $sql = "SELECT * FROM users
            WHERE id = {$_SESSION["user_id"]}";
            
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
		return true;
	}
}




function conn(){ //fuction gia connection me db
	   // database credentials localhost 3306
	$server ="localhost";
	$db ="website";
	$username ="phpmyadmin";
	$password ="root";

	// Connect to the database using mysqli

	$mysqli = new mysqli($server, $username, $password, $db);

	if ($mysqli->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} else {
			//echo("connection success");
		}

		return($mysqli);
	}
	

?>