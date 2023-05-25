<?php
error_reporting(E_ALL); ini_set('display_errors', '1');
require __DIR__ . '/functions.php';
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
	
	<h1>Sign Up was Successfull.</h1>
	<hr>
	<p>You must <a href="https://texnologies-web-kbvhp.run-eu-central1.goorm.site/login.php">Login</a> </p>
    <hr>
	
<script src="main.js">
</script>
</body>
</html>