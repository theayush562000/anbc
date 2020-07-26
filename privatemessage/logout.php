<?php 
session_start();
if(isset($_SESSION['username'])) {
	//session is active let it destroy
	unset($_SESSION['username']);
	//also change the location back to login page
	header("location:login.php");
}else {
	//if sessionnot active
	//then change only the location
	//to login page
	header("location:login.php");
}