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
	overflow: hidden;
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
	<title>Signup</title>
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
	
	<h1>Sign Up</h1>
	
<form method="POST" action="signup-process.php" > 
  <div class="container">
	<p>Please fill in this form to create an account.</p>
  	<label for="name"><b>Name</b></label>
    <input type="text" placeholder="Enter your name" name="name" >
	  
	<label for="surname"><b>Surname</b></label>
    <input type="text" placeholder="Enter surname" name="surname" required>
	  
	<label for="username"><b>Username</b></label>
    <input type="text" placeholder="Enter username" name="username" required>
	  
    <label for="email"><b>Email</b></label>
    <input type="text" placeholder="Enter Email" name="email" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" required>
	  
	<label for="simplepush_key"><b>Simplepush.io key</b></label>
    <input type="text" placeholder="Enter Simplepush.io key/Optional" name="simplepush_key" >
	  

    <div class="clearfix">
      <!--<button type="button" class="cancelbtn"  onclick="redirect()">Cancel</button>-->
		<script>
			function redirect() {
  			location.replace("index.php")
		}
		</script>
		
      <button type="submit" class="signupbtn">Sign Up</button>
   		 </div>
  </div>
	

</form>




	
<script src="main.js">
</script>
</body>
</html>
