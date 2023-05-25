<?php
require_once __DIR__ . '/functions.php';
ini_set ('display_errors', 1); ini_set ('display_startup_errors', 1); error_reporting(E_ALL);
 if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
	if (!check_login()){ //authentication for user
		echo "<script>
			alert('You must sign up or log in');
			window.location.href='login.php';
			</script>";
    	die();
	}
	$id = (int) $_SESSION["user_id"]; // id = user_id
$is_invalid = false; 
if ($_SERVER["REQUEST_METHOD"] == "POST") {

	if (!(empty($_POST["title"]) && !(empty($_POST["content"])))) {
		
		$mysqli = conn();
		// Retrieve the  data using $_POST
		$title = $_POST['title'];
		$content = $_POST['content'];
		$query = "INSERT INTO `posts`(`title`,`content`,`user_id`,`date` ) VALUES (?,?,?,CURRENT_TIMESTAMP())";
		// SQL injection protection
		$stmt = $mysqli->prepare($query);

		//Insert data into database
		$stmt->bind_param("ssi", $title, $content, $id);

		$stmt->execute();

		// error handle	
		if (mysqli_stmt_errno($stmt) == 1406) {
			echo "<script>
			alert('Data too long');
			window.location.href='/postq.php';
			</script>";
		}

		if (mysqli_stmt_errno($stmt)) {

			die("Database error: " . mysqli_stmt_error($stmt));
		}


		// Go back to home
			echo "<script>
			alert('Your question was submitted!');
			window.location.href='/forum.php';
			</script>";

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
input[name="title"] { 
  width: 50%;
  padding: 15px;
  margin: 5px 0 22px 0;
  display: inline-block;
  border: none;
  background: #ddd;
}

textarea{
  width: 100%;
  height: 150px;
  padding: 12px 20px;
  box-sizing: border-box;
  border: 2px solid #ccc;
  border-radius: 4px;
  background-color: #f8f8f8;
  resize: none;
  text-align: left;
}
label{
	display: block;
}


input[type=text]:focus {
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
</style>
	<head>
		<link rel="stylesheet" href="main.css">
	<title>Post a question</title>
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

	<h1>Ask a question</h1>
	<hr>
	<p>Please put in a title and your question.</p>
    <hr>
<form method="POST" action="postq.php" > <!-- Inserting post and title -->
  <div class="container">    
    <label for="title"><b>Title</b></label>
    <input type="text" placeholder="Enter a title" name="title" required>

    <label for="content"><b>Context</b></label>
	  <textarea id="content" name="content" placeholder="Write something" required></textarea>
	  
	  
    <div class="clearfix">
      <button type="button" class="cancelbtn"  onclick="redirect()">Cancel</button>
		<script> //an patiso cancel
			function redirect() {
  			location.replace("index.php")
		}
		</script>
		
      <button type="submit" class="signupbtn">Post</button>
   		 </div>
  </div>
</form>
	<h2>
	 <?php if ($is_invalid): // akira stixia ?> 
        <em>Invalid Submission</em> 
    <?php endif; ?>
	</h2>

<script src="main.js">
</script>
</body>
</html>