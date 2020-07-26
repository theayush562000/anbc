<?php
 session_start();
 if(isset($_SESSION['username'])) {

   //echo 'how are you '.$_SESSION['username'];
  
 ?>
<!DOCTYPE html>
<html>
<head><meta name="viewport" content="width=device-width,initial-scale=1.0"></head>
	<style type="text/css">
		<?php require_once("sub_file/style.php"); ?>
		
	</style>
<body>
	
	<?php require_once("sub_file/new-message.php");?>
<div id="container">
	<div id="menu">
		<?php

		 echo $_SESSION['username'];
		 echo '<a style="float:right; color:white;" href="logout.php">Log out</a>';
		 echo '<a style="float:right; color: orange; border: double; border-radius: 12px; padding-right: 20px; padding-left: 10px;" href="index.html">One india</a>';
		 echo '<a style="float:right; color: #25D366; border: double; border-radius: 12px; padding-right: 20px; padding-left: 10px;" href="videocalling.html">VideoCall</a>';
		 ?>
	</div>
	<div id="left-col">
		<?php require_once("sub_file/left-col.php"); ?>
		<!--end of left-colomn -->
	</div>

	<div id="right-col">
		<?php require_once("sub_file/right-col.php"); ?>
			<!--end of right col -->
		</div>
	</div>
</body>
</html>

 <?php

 }else {
 	header("location:login.php");
 }
 
 ?>