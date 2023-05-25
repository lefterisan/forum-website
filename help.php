<?php
ini_set ('display_errors', 1); ini_set ('display_startup_errors', 1); error_reporting(E_ALL);
 if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="main.css">
	<title>Help page</title>
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
	
	<h1>Help</h1>
	<div class = "help">
		<h2>How do i sign up?</h2>
		<p>You click the sign up button at the navigation bar top right.</p>
		<hr>
		<h2>Is my information at risk when I sign up?</h2>
		<p>Yup we sell it to the highest bidder. Everything from names, emails, frequently used passwords and IP adresses.</p>
		<hr>
		<h2>I suffer from cronic back pain, how do I treet it?</h2>
		<p>Well sorry to hear that but this is a student website, can't really help you :(</p>
		<hr>
		<h2>I am feeling pretty depressed latelty, any advice?</h2>
		<p><a href="https://www.youtube.com/watch?v=KWrFdEhyKjg">This video </a> always helped when I was felling down!</p>
		<hr>
		<h2>Is Fallout New Vegas really the best RPG?</h2>
		<p>Without a doupt! The best dialogue, the best characters,the best atmoshere and the best and most balanced leveling up system. What more do you need?</p>
	</div>
	<div class = "imghelp">
		<p>
			<img src="https://i.guim.co.uk/img/media/3aab8a0699616ac94346c05f667b40844e46322f/0_123_5616_3432/master/5616.jpg?width=700&quality=85&auto=format&fit=max&s=a476da702aff265ce6f586be1412b1e1">
		</p>
	</div>
	<script src="main.js">
	</script>
</body>
</html>