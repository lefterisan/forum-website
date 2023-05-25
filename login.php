<?php

require_once __DIR__ . '/functions.php';
ini_set ('display_errors', 1); ini_set ('display_startup_errors', 1); error_reporting(E_ALL);
 if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
if (check_login()){ //authentication gia sindedemenous (den exoun logo na einai edo)
	echo "<script>
	alert('You must logout first');
	window.location.href='index.php';
	</script>";
    die();
	}
$is_invalid = false; 

if ($_SERVER["REQUEST_METHOD"] === "POST") {   //otan gini sumbit
    
	$mysqli = conn();
    
    $sql = sprintf("SELECT * FROM users
                    WHERE email = '%s'",
                   $mysqli->real_escape_string($_POST["email"])); //sqlinjection protect
    
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
    
    if ($user) { //iparxi o user?
        
        if (password_verify($_POST["psw"], $user["psw"])) {  //verify password-hash
            
            session_start();
            
            session_regenerate_id();
            //inserting $user{} from sql into $_session{} gia na mporo na ta xrisimopoio se olo to site
            $_SESSION["user_id"] = $user["id"];
			$_SESSION["name"] = $user["name"];
			$_SESSION["surname"] = $user["surname"];
			$_SESSION["email"] = $user["email"];
			$_SESSION["username"] = $user["username"];
			$_SESSION["psw"] = $user["psw"]; 
			$_SESSION["simplepush_key"] = $user["simplepush_key"];
            
            header("Location: index.php");
            exit;
        }
    }
    
    $is_invalid = true;
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
  background-color: darkgray;
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

.cancelbtn, .signupbtn {
  color: white;
  padding: 14px 20px;
  border: none;
  cursor: pointer;
  width: 33vh;
  opacity: 0.9;
 display: inline-block; 
}

/* padding */
.container {
	display: block;
	border: 1px solid faintgrey;
  padding: 16px;
	background-color: white;
	width: 40vh;
	margin: 0 auto;
}

/* Clear floats */
.clearfix::after {
  content: "";
  clear: both;
}
	form{
		text-align: center;
	}
</style>
	<head>
		<link rel="stylesheet" href="main.css">
	<title>Login</title>
	       <link rel = "icon" href = 
"https://thumbs.dreamstime.com/z/computer-logo-pc-logo-vector-computer-logo-pc-logo-vector-142583250.jpg" 
        type = "image/x-icon">
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
	
	<h1>LOGIN</h1>
    <hr>
<form method="POST" action="login.php" >
  <div class="container">
	<p>Please fill in this form to log in an account.</p>
    <label for="email"><b>Email</b></label>
    <input type="text" placeholder="Enter Email" name="email" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" required>
	  
   <!-- <label>
      <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Remember me
    </label>
	-->
	  
    <div class="clearfix">
      <!--<button type="button" class="cancelbtn"  onclick="redirect()">Cancel</button>-->
		<script> //an patiso cancel
			function redirect() {
  			location.replace("index.php")
		}
		</script>
	
      <button type="submit" class="signupbtn">Login</button>
   		 </div>
	  <hr>
	  <p>Don't have an account? <a href="https://texnologies-web-kbvhp.run-eu-central1.goorm.site/signup.php">click here!</a>
		  <hr>
	  	<a href="https://static9.depositphotos.com/1011382/1144/i/950/depositphotos_11444953-stock-photo-shoulder-shrug.jpg">Forgot Password</a>
  </div>
</form>
	<h2>
	 <?php if ($is_invalid): // akira stixia ?> 
        <em>Invalid login</em> 
    <?php endif; ?>
	</h2>

<script src="main.js">
</script>
</body>
</html>
