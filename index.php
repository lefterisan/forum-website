<?php
 if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
error_reporting(E_ALL); ini_set('display_errors', '1');
require_once __DIR__ . '/functions.php';
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="main.css">
	<meta charset+"UTF-8"> 
	<title>Main page</title>
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

<h1>Welcome to our site! A community driven site for technical questions &#38; answers !</h1>
	<hr>
	<h2>
		Why should you register?
	</h2>
	<p>So we can sell your data and not face consiquences  </p>
	
	<hr>
		<h2>
		How can I sign up?
		</h2>
	<p>Give us your credit card info </p>
	<hr>
		<h2>
		Need more help? <a href="https://texnologies-web-kbvhp.run-eu-central1.goorm.site/help.php">click here!</a>
		</h2>
	<p>
	<img src="https://di.ionio.gr/images/content/og_image.jpg" width="600" height="0" align="bottom">
	</p>
	
	<p>
		<img src="https://decaldivision.co.za/image/cache/catalog/Motorsport/PERFORMANCE/Powered%20by%20VTEC%20Sticker-590x590.png" width="90" height="0" align="right" >
	</p>
	<p>
		<img src="https://cdn.dribbble.com/users/58639/screenshots/3788063/936.jpg" width="100" height="0" align="left" >
	</p>
<script src="main.js">
</script>
</body>
</html>