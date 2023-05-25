<?php
ini_set ('display_errors', 1); ini_set ('display_startup_errors', 1); error_reporting(E_ALL);
require_once __DIR__ . '/functions.php';
 if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
	if (!check_login()){ //authentication 
		echo "<script>
			alert('You must sign up or log in');
			window.location.href='login.php';
			</script>";
    die();
	}
	
	$id = (int) $_SESSION["user_id"]; // id xristi
	//connection
	$mysqli = conn();
 	if(isset($_POST['delete'])) { //delete account and replacing with random values
	 //xrisi MD5(RAND()) gia random xaraktires.
	 	$query = "UPDATE  users 
		SET name=MD5(RAND()), surname = MD5(RAND()), email = MD5(RAND()), username = MD5(RAND()),psw = MD5(RAND()), simplepush_key = SUBSTR(MD5(RAND()), 1, 6) 
		WHERE id=?"; 
		// SQL injection protection
		$stmt = $mysqli->prepare($query);
		//Insert data into database
		$stmt->bind_param("i",$id);
		$stmt->execute();
		echo "<script>
		alert('Account successfully deleted');
		window.location.href='index.php';
		</script>";
		header("Location: logout.php");
		die();
        }
	if ($_SERVER["REQUEST_METHOD"] == "POST") { //otan gini sumbit
		//server side validation- error handling
		if( empty($_POST["name"]) && empty($_POST["surname"]) && empty($_POST['username']) && empty($_POST["email"]) &&  empty($_POST["psw"]) && empty($_POST['simplepush_key'])){ //if all fields are empty
			echo "<script>
			alert('You must fill in at least one space');
			window.location.href='profile.php';
			</script>";
			die();
		}
		if ( (!preg_match("/^[a-zA-Z-']*$/",$_POST["name"])) || (!preg_match("/^[a-zA-Z-']*$/",$_POST["surname"]))){
			echo "<script>
			alert('Only letters in Name and/or Surname');
			window.location.href='profile.php';
			</script>";
			die();
		}
		if ( !(empty($_POST["email"])) && (! filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)) ){
			echo "<script>
			alert('Invalid Email');
			window.location.href='profile.php';
			</script>";
			die();
		}
		// Update the values which are not empty.
		if (!(empty($_POST["name"]))){	
			$name = $_POST['name'];
			$query = "UPDATE  users SET name=? WHERE id=?";
			// SQL injection protection
			$stmt = $mysqli->prepare($query);
			//Insert data into database
			$stmt->bind_param("si", $name,$id);
			$stmt->execute();
			$_SESSION["name"] = $_POST['name']; //alagi tou $_session me to $_post gia na fanun oi alages 
		}
		if (!(empty($_POST["surname"]))){	
			$surname = $_POST['surname'];
			$query = "UPDATE  users SET surname=? WHERE id=?";
			// SQL injection protection
			$stmt = $mysqli->prepare($query);
			//Insert data into database
			$stmt->bind_param("si", $surname,$id);
			$stmt->execute();
			$_SESSION["surname"] = $_POST['surname'];
		}
		if (!(empty($_POST["username"]))){	
			$username = $_POST['username'];
			$query = "UPDATE  users SET username=? WHERE id=?";
			// SQL injection protection
			$stmt = $mysqli->prepare($query);
			//Insert data into database
			$stmt->bind_param("si", $username,$id);
			$stmt->execute();
			
			// error handle gia duplicate 
			
			if (mysqli_stmt_errno($stmt) == 1062) {
				echo "<script>
				alert('Email or username already exist');
				window.location.href='profile.php';
				</script>";
				die();
			}
			$_SESSION["username"] = $_POST['username'];
		}
		if (!(empty($_POST["email"]))){		
			$email = $_POST['email'];
			$query = "UPDATE  users SET email=? WHERE id=?";
			// SQL injection protection
			$stmt = $mysqli->prepare($query);
			//Insert data into database
			$stmt->bind_param("si", $email,$id);
			$stmt->execute();
			
				// error handle gia duplicate 
			if (mysqli_stmt_errno($stmt) == 1062) {
				echo "<script>
				alert('Email or username already exist');
				window.location.href='profile.php';
				</script>";
				die();
			}
			$_SESSION["email"] = $_POST['email'];
		}
		if (!(empty($_POST["psw"]))){	
			$psw = $_POST['psw'];
			$psw = password_hash($psw, PASSWORD_DEFAULT); //hashing password
			$query = "UPDATE  users SET psw=? WHERE id=?";
			// SQL injection protection
			$stmt = $mysqli->prepare($query);
			//Insert data into database
			$stmt->bind_param("si", $psw,$id);
			$stmt->execute();
			$_SESSION["psw"] = $_POST['psw'];
		}
		if (!(empty($_POST["simplepush_key"]))){
			$simplepush_key = $_POST['simplepush_key'];
			$query = "UPDATE  users SET simplepush_key=? WHERE id=?";
			// SQL injection protection
			$stmt = $mysqli->prepare($query);
			//Insert data into database
			$stmt->bind_param("si", $simplepush_key,$id);
			$stmt->execute();
			$_SESSION["simplepush_key"] = $_POST['simplepush_key'];
		}

	if (mysqli_stmt_errno($stmt)) {

		die("Database error: " . mysqli_stmt_error($stmt));
	}
		echo "<script>
			alert('Changes were submitted successfully');
			</script>";
		} 
?>

<!DOCTYPE html>
<html>
<style>
body {font-family: Arial, Helvetica, sans-serif;
	 background-color: lightgray;}

/* input fields */
input[type=text], input[type=password] {
  width: 30vh;
  height: 2vh;
  padding: 15px;
  margin: 5px 0 22px 0;
  display: inline-block;
  border: none;
  background: #ddd;
	text-align: center;
}
 
	label{
		display: block;
	}


input[type=text]:focus, input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}


button:hover {
  opacity:1;
}

/* Extra styles for the cancel button */
.cancelbtn {
  background-color: #f44336;

}
	
.signupbtn{
	background-color: #04AA6D;
}
.deletebtn{
  color: white;
  padding: 14px 20px;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
  display: inline-block;
  background-color: blue;
}
.cancelbtn, .signupbtn {
  color: white;
  padding: 14px 20px;
  border: none;
  cursor: pointer;
  width: 49%;
  opacity: 0.9;
 display: inline-block; 
}

/* padding */
.container {
  padding: 16px;
}

/* Clear floats */
.clearfix::after {
  content: "";
  clear: both;
}
	form{
		text-align: center;
	}
	
	input::placeholder {
    font-weight: bold;
    opacity: 1;
    color: black;
}
</style>
	<head>
		<link rel="stylesheet" href="main.css">
		<meta charset+"UTF-8"> 
	<title>Your profile</title>
	       <link rel = "icon" href ="https://thumbs.dreamstime.com/z/computer-logo-pc-logo-vector-computer-logo-pc-logo-vector-142583250.jpg" type = "image/x-icon">
	</head>
<body>
	<?php include 'nav.php';?>
	<hr>
	<div class="accordion">
		<div class="accordion-item"> 
			<div class="accordion-header">
				<button class="accordion-btn"></button>
			</div>
		<div class="accordion-content">
		<?php include 'accordion.php';?>
		</div>
	</div>
	</div>
	
	<h1>Edit your profile</h1>
	<hr>
	<p>Fill in the fields you want to edit</p>
    <hr>
	
<form method="POST" action="profile.php" > 
  <div class="container">
  	<label for="name"><b>Change Name</b></label>
    <input type="text" placeholder="<?php echo $_SESSION['name']; ?>" name="name" >
	  
	<label for="surname"><b>Change Surname</b></label>
    <input type="text" placeholder="<?php echo $_SESSION['surname']; ?>" name="surname" >
	  
	<label for="username"><b>Change Username</b></label>
    <input type="text" placeholder="<?php echo $_SESSION['username']; ?>" name="username" >
	  
    <label for="email"><b>Change Email</b></label>
    <input type="text" placeholder="<?php echo $_SESSION['email']; ?>" name="email" >

    <label for="psw"><b>Change Password</b></label>
    <input type="password" placeholder="Change password" name="psw" >
	  
	<label for="simplepush_key"><b>Change Simplepush.io key</b></label>
    <input type="text" placeholder="<?php echo $_SESSION['simplepush_key']; ?>" name="simplepush_key" >
	  

    <div class="clearfix">
      <button type="button" class="cancelbtn"  onclick="redirect()">Cancel</button>
		<script>
			function redirect() {
  			location.replace("index.php")
		}
		</script>
		
      <button type="submit" class="signupbtn">Edit</button>
   		 </div>
  </div>
		<hr>
	<p>Or delete account</p>
	<div class="clearfix">
		   <input type="submit" name="delete" class="deletebtn" value="Delete"/>
	</div>
</form>
	
<script src="main.js">
</script>
</body>
</html>