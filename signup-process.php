<?php
 if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
error_reporting(E_ALL); ini_set('display_errors', '1');
//print_r($_POST);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$is_valid=true;
	//input validation
	if (empty($_POST["name"])) {
			echo "<script>
			alert('Name is required');
			window.location.href='signup.php';
			</script>";
			$is_valid=false;
		} else {
		if (!preg_match("/^[a-zA-Z-']*$/",$_POST["name"])) { //mono gramata
			echo "<script>
			alert('Only letters in Name');
			window.location.href='signup.php';
			</script>";
			$is_valid=false;
			}
		}
	if (empty($_POST["surname"])) {
			echo "<script>
			alert('Surname is required');
			window.location.href='signup.php';
			</script>";
			$is_valid=false;
		} else {
			if (!preg_match("/^[a-zA-Z-']*$/",$_POST["surname"])) {
			echo "<script>
			alert('Only letters in surname');
			window.location.href='signup.php';
			</script>";
			$is_valid=false;
			}
		}
	if (empty($_POST['username'])){
			echo "<script>
			alert('Username is required');
			window.location.href='signup.php';
			</script>";
			$is_valid=false;
	}

	if (empty($_POST["email"])) {
			echo "<script>
			alert('Email is required');
			window.location.href='signup.php';
			</script>";
			$is_valid=false;
		} else { 
			if (! filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){ //elenxos email
			echo "<script>
			alert('Email is invalid');
			window.location.href='signup.php';
			</script>";
			$is_valid=false;
			}
		}	
	if (empty($_POST["psw"])) {
			echo "<script>
			alert('Name is required');
			window.location.href='signup.php';
			</script>";
			$is_valid=false;
	}
	if (empty($_POST['simplepush_key'])){
		$_POST['simplepush_key'] = "000000";
	}
	if ($is_valid==false){
   		exit();
	}
	require_once __DIR__ . '/functions.php';

	$mysqli = conn();


	// Retrieve the  data using $_POST
	$name = $_POST['name'];
	$surname = $_POST['surname'];
	$username = $_POST['username'];
	$email = $_POST['email'];
	$psw = $_POST['psw'];
	$simplepush_key = $_POST['simplepush_key'];


	//hashing password
	$psw = password_hash($psw, PASSWORD_DEFAULT);

	$query = "INSERT INTO users (name, surname, username, email, psw, simplepush_key) VALUES (?, ?, ?, ?, ?, ?)";
	// SQL injection protection
	$stmt = $mysqli->prepare($query);

	//Insert data into database
	$stmt->bind_param("ssssss", $name, $surname, $username, $email, $psw, $simplepush_key);

	$stmt->execute();

	// error handle
	if (mysqli_stmt_errno($stmt) == 1062) { //error code gia duplicate, to email h to username iparxun idi
		
		echo "<script>
			alert('Email or Username already exist'); 
			window.location.href='signup.php';
			</script>";
		exit;
	}
	
	if (mysqli_stmt_errno($stmt) == 1406) { 
		echo "<script>
		alert('Data too long');
		window.location.href='signup.php';
		</script>";
	exit;
	}
	
	if (mysqli_stmt_errno($stmt)) {

		die("Database error: " . mysqli_stmt_error($stmt));
	}


	// Go to signup success page
	header("Location: signup-success.php");
	 exit;

}
?>

