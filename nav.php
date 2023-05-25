<?php
require_once __DIR__ . '/functions.php';
ini_set ('display_errors', 1); ini_set ('display_startup_errors', 1); error_reporting(E_ALL);
 if(!isset($_SESSION)) 
    { 
        session_start();
    }
//diaforetiko navbar gia sindedemenous xristes
if (check_login()){ 
	echo '
		<ul>
		<div class ="link"> 
			<li><a href="/index.php">Main page</a> </li>
			<li> <a href="/forum.php"> Forum</a> </li>
			<li> <a href="/help.php">Help</a> </li>
			<li> <a href="/postq.php">Make a question</a> </li>
			<li><a href="/create_xml.php">XML</a> </li>
			<li> <a href="/logout.php"class = "split">Logout</a> </li>	
			<li><a href="/profile.php"class = "split">'.$_SESSION["username"].'</a></li> <td> 
		</div>	
		</ul>';
}else{
	echo '
		<ul>
		<div class ="link"> 
			<li><a href="/index.php">Main page</a> </li>
			<li> <a href="/forum.php">Forum</a> </li>
			<li> <a href="/help.php">Help</a> </li>
			<li><a href="/create_xml.php">XML</a> </li>
			<li> <a href="login.php" class = "split"> Login </a> </li>
			<li> <a href="signup.php" class = "split"> Sign up </a> </li>
		</div>
		</ul>';
}	
?>