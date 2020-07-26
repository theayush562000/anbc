<?php
session_start();
 require_once("connection.php") ;?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		* {margin: 0px; padding: 0px;}
			#container{ width: 300px; margin: 0px auto;}
		.input {width: 92%;padding: 2%;}
	</style>
</head>
<body>
	<h1 align="center">Login Form</h1>
	<div id="container">
		<form method="post">
			<input type="text" name="user_name" class="input" placeholder="user_name"><br><br>
			<input type="password" name="password" class="input" placeholder="password"><br><br>
			<input type="submit" name="login" class="input" value="login">
			<a href="register.php">Register here</a>
		</form>
	</div>

    <?php
      if(isset($_POST['login'])) {
      	$user_name = $_POST['user_name'] ;
      	$password = $_POST['password'] ;

      	$q='SELECT * FROM `users` WHERE `user_name`="'.$user_name.'" AND `password`="'.$password.'" ';

      	$r=mysqli_query($con, $q);
      	if($r) {
             if(mysqli_num_rows($r)>0) {
             	//login succcessful
             	
             	$_SESSION['username'] = $user_name;
             	header("location:index.php");
             }else {
             	//login failed
             	echo 'Your password and user name do not matched';
             }
      	}else {
      		//problem in query
      		echo $q;
      	}
      }


     ?> 
    

</body>
</html>