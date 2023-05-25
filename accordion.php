<?php
require_once __DIR__ . '/functions.php';
ini_set ('display_errors', 1); ini_set ('display_startup_errors', 1); error_reporting(E_ALL);
 if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
//diaforetiko menu gia sindedemenous xristes
if (check_login()){
echo '<p><a href="/">Main page</a>
			<p><a href="/help.php">Help</a> </p>
			<p><a href="/profile.php">Profile</a> </p>
			<p><a href="/logout.php">Logout</a> </p>
			<p><a href="/postq.php">Make a question</a> </p>';
	}else{
	echo '<p><a href="https://texnologies-web-kbvhp.run-eu-central1.goorm.site/">Main page</a>
			<p><a href="/help.php">Help</a> </p>
			<p><a href="/signup.php">Signup</a> </p>
			<p><a href="/login.php">Login</a></p>';
}
?>