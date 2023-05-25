<?php
require_once __DIR__ . '/functions.php';
ini_set ('display_errors', 1); ini_set ('display_startup_errors', 1); error_reporting(E_ALL);
 if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
	if (!check_login() && ($_SERVER["REQUEST_METHOD"] == "POST")){ //authentication 
		echo "<script>
			alert('You must sign up or log in');
			window.location.href='login.php';
			</script>";
    	die();
	}
	$mysqli = conn();
	$user_id = (int) $_SESSION["user_id"]; //metatropi se interget gt to _session{id} einai string
    $post_id = (int) $_GET{"post_id"};
	$sql = "SELECT * FROM comments WHERE post_id= $post_id ORDER BY date "; //pare ta comments
	$result = mysqli_query($mysqli,$sql);
	$sql = "SELECT * FROM posts WHERE post_id= $post_id"; //pare to post
	$post_result = mysqli_query($mysqli,$sql);

		
	$is_invalid = false; 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
 //Inserting comment
	if (!(empty($_POST["content"]))) {
		//inserting data from comment
		$content = $_POST['content'];
		$query = "INSERT INTO `comments`(`content`,`user_id`,`post_id`,`date` ) VALUES (?,?,?,CURRENT_TIMESTAMP())";
		// SQL injection protection
		$stmt = $mysqli->prepare($query);

		//Insert data into database
		$stmt->bind_param("sii",$content, $user_id,$post_id );

		$stmt->execute();

		// error handle	
		if (mysqli_stmt_errno($stmt) == 1406) {
			echo "<script>
			alert('Data too long');
			window.location.href='signup.php';
			</script>";
		}

		if (mysqli_stmt_errno($stmt)) {

			die("Database error: " . mysqli_stmt_error($stmt));
		}


		// refresh kai apofigi resubmit se refesh
		unset($_POST);
		$_POST = array();
	header("Location: http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");

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
  background: #f1f1f1;
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
	<title>Forum</title>
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
	
	<h1>Post</h1>
	<?php $post_result=mysqli_fetch_array($post_result) ?>
	<table align="center" border="1px"  class="table-post" > <!-- Show post -->
		<tr>
			<th>UserID</th>
			<th>Title</th>
			<th>Date</th>
		</tr>
		<tr>
			<td><?php echo $post_result{'user_id'} ?></td>
			<td><?php echo $post_result{'title'} ?> </td>
			<td><?php echo $post_result{'date'} ?></td>
		</tr>
	</table>
	<hr>
	<table align="center" border="1px"  class="table-content">
		<tr><th>Content</th></tr>
		<tr><td><?php echo $post_result{'content'} ?></td></tr>
	</table>
	<hr>
	<h2>Comments</h2>
	<hr>
	<table align="center" border="1px" border-radius="1500px" class="table-comments" > <!-- Show all the comments -->
		<tr>
			<th>UserID</th>
			<th>Comment</th>
			<th>Date</th>
		</tr>
		<?php
		while($rows=mysqli_fetch_array($result))
		{ ?>
			<tr>
				<td><?php echo $rows{'user_id'} ?></td>
				<td><?php echo $rows{'content'} ?></td>
				<td><?php echo $rows{'date'} ?></td>
				
			</tr>
		<?php
		}
		?>
	</table>
		
	<hr>
	<p>Comment something</p>
    <hr>
<form method="POST" >
  <div class="container">    
    <label for="content"><b>Comment</b></label>
	  <textarea id="content" name="content" placeholder="Write your comment here" required></textarea>
	  
	  
    <div class="clearfix">
      <button type="button" class="cancelbtn"  onclick="window.location.href='forum.php'">Cancel</button>
		<script> //an patiso cancel
			function redirect() {
  			location.replace("index.php")
		}
		</script>
		
      <button type="submit" class="signupbtn">Sumbit comment</button>
		<script> //an patiso cancel
			function redirect() {
  			location.replace('posta.php?post_id=')
		}
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